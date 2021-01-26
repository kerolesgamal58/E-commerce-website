<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\File;
use App\Models\Mall;
use App\Models\MallProduct;
use App\Models\OtherData;
use App\Models\Product;
use App\Models\Size;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use function App\Helper\copyProductFiles;
use function App\Helper\copyProductImages;
use function App\Helper\deleteProduct;
use function App\Helper\deleteProductFiles;
use function App\Helper\getParentDeps;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('admin.product.showall', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->except(['_token', 'main_image', 'image', 'mall', 'input_key', 'input_value']);
        $product = Product::create($data);
        Product::where('id', $product->id)->update([
            'main_image' => $request->file('main_image')->store('images/products/'.$product->id),
        ]);

        if ($request->has('image') and count($request->image) > 0) {
            foreach ($request->file('image') as $image) {
                $size = filesize($image);
                $image_info = pathinfo($image->getClientOriginalName());
                $image_path = $image->move(public_path('storage/images/products/' . $product->id), $image->hashName());
                $image_path = str_replace(public_path('storage/'), '', $image_path);
                $image_path = str_replace('\\', '/', $image_path);
                $sub_image = [];
                $sub_image = [
                    'file_prev_name' => $image_info['basename'],
                    'type' => $image_info['extension'],
                    'size' => $size,
                    'product_id' => $product->id,
                    'file' => $path = $image_path,
                ];
                File::create($sub_image);
            }
        }

        if ($request->has('mall') and count($request->mall) > 0) {
            for ($i = 0, $j = count($request->mall); $i < $j; $i++) {
                $mall_product = [
                    'product_id' => $product->id,
                    'mall_id' => $request->mall[$i],
                ];
                MallProduct::create($mall_product);
            }
        }

        if (($request->has('input_key') and count($request->input_key) > 0) or
            ($request->has('input_value') and count($request->input_value) > 0)) {
            for ($i = 0, $j = count($request->input_key); $i < $j; $i++) {
                $data = [];
                $data = [
                    'product_id' => $product->id,
                    'data_key' => $request->input_key[$i] ? $request->input_key[$i] : '',
                    'data_value' => $request->input_value[$i] ? $request->input_value[$i] : '',
                ];
                OtherData::create($data);
            }
        }

        return redirect()->route('product.showproducts');
    }

    // End store

    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product)
            return redirect()->route('product.showproducts')->with(['error' => 'could not find this product']);
        $images = $product->files;
        $malls = $product->malls;
        $other_data = $product->other_data;
        $array_of_malls = [];
        foreach ($malls as $mall) {
            array_push($array_of_malls, (int)$mall->id);
        }
        return view('admin.product.edit', ['product' => $product, 'images' => $images, 'malls' => $array_of_malls, 'other_data' => $other_data]);
    }

    public function update(ProductRequest $request, $id)
    {
        $this->updateProduct($request, $id);

        return redirect()->route('product.showproducts');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product)
            return redirect()->route('product.showproducts')->with(['error' => 'error']);

        deleteProduct($id);
        return redirect()->route('product.showproducts');
    }

    public function deleteselected(Request $request)
    {
        if (is_null($request->ids))
            return;

        foreach ($request->ids as $id) {
            $product = Product::find($id);
            if (!$product)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            deleteProduct($id);
        }
        return response()->json([
            'status' => true,
            'msg' => 'The product is deleted successfully',
        ]);
    }

    public function load_size_weight(Request $request)
    {
        if ($request->ajax() and $request->has('dep_id')) {
            $size1 = Size::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name')->where('is_public', 'yes')->whereIn('department_id', getParentDeps($request->dep_id))->get()->toArray();
            $size2 = Size::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name')->where('department_id', $request->dep_id)->get()->toArray();
            $sizes = array_merge($size1, $size2);
            $weights = Weight::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name')->get();
            if ($request->has('product_id'))
                $product = Product::find($request->product_id);
            else
                $product = null;
            return view('admin.product.ajax.size_weight', ['sizes' => $sizes, 'weights' => $weights, 'product' => $product]);
        } else {
            return 'Please enter a department';
        }
    }

    public function saveAndContinue(ProductRequest $request, $id){
        if ($request->ajax()){
            $this->updateProduct($request, $id);
            return 'success';
        }
    }

    public function copy(Request $request){
        if ($request->ajax()){
            $old_product = Product::find($request->product_id);
            $data = $old_product->makeHidden([
                'main_image', 'created_at', 'update_at'
            ])->toArray();
            //copy old product to new one
            $new_product = Product::create($data);
            copyProductImages($old_product->id, $new_product->id);
            $old_files = $old_product->files;
            foreach($old_files as $file){
                copyProductFiles($file, $old_product->id, $new_product->id);
            }
            $old_other_data = $old_product->other_data;
            foreach($old_other_data as $other_data){
                $data = $other_data->makeHidden(['created_at', 'updated_at', 'product_id'])->toArray();
                $data = array_merge($data, ['product_id' => $new_product->id]);
                OtherData::create($data);
            }
            $old_malls = $old_product->malls;
            foreach($old_malls as $mall){
                $data = ['mall_id' => $mall->pivot->mall_id, 'product_id' => $new_product->id];
                MallProduct::create($data);
            }
            return route('product.edit', $new_product->id);
        }
    }

    function updateProduct(Request $request, $id){
        $product = Product::find($id);
        if (!$product)
            return redirect()->route('product.showproducts')->with(['error' => 'could not find this product']);

        $data = $request->except(['_token', 'main_image', 'image', 'mall', 'input_key', 'input_value']);
        $product->update($data);

        $all_new_malls_arr = [];
        foreach ($request->mall as $new_mall) {
            array_push($all_new_malls_arr, (int)$new_mall);
        }

        $all_old_malls_arr = [];
        foreach ($product->malls as $old_mall) {
            array_push($all_old_malls_arr, $old_mall->id);
        }

        $mall_intersection = array_intersect($all_old_malls_arr, $all_new_malls_arr);
        $new_malls = array_diff($all_new_malls_arr, $mall_intersection);
        $old_malls = array_diff($all_old_malls_arr, $mall_intersection);
        foreach ($new_malls as $mall) {
            MallProduct::create([
                'product_id' => $id,
                'mall_id' => $mall,
            ]);
        }
        foreach ($old_malls as $mall) {
            MallProduct::where('product_id', $id)->where('mall_id', $mall)->delete();
        }

        $no_of_received_input_keys = count($request->input_key);
        $no_of_input_keys_in_db = count($product->other_data);
        if ($no_of_received_input_keys > $no_of_input_keys_in_db) {
            for ($i = 0, $j = $no_of_input_keys_in_db; $i < $j; $i++) {
                $product->other_data[$i]->update([
                    'data_key' => $request->input_key[$i],
                    'data_value' => $request->input_value[$i],
                ]);
            }
            for ($i = 0, $j = $no_of_received_input_keys - $no_of_input_keys_in_db; $i < $j; $i++) {
                OtherData::create([
                    'product_id' => $id,
                    'data_key' => $request->input_key[$no_of_input_keys_in_db + $i],
                    'data_value' => $request->input_value[$no_of_input_keys_in_db + $i],
                ]);
            }
        } elseif ($no_of_received_input_keys == $no_of_input_keys_in_db) {
            for ($i = 0, $j = $no_of_input_keys_in_db; $i < $j; $i++) {
                $product->other_data[$i]->update([
                    'data_key' => $request->input_key[$i],
                    'data_value' => $request->input_value[$i],
                ]);
            }
        } else {
            for ($i = 0, $j = $no_of_received_input_keys; $i < $j; $i++) {
                $product->other_data[$i]->update([
                    'data_key' => $request->input_key[$i],
                    'data_value' => $request->input_value[$i],
                ]);
            }
            for ($i = 0, $j = $no_of_input_keys_in_db - $no_of_received_input_keys; $i < $j; $i++) {
                OtherData::where('id', $product->other_data[2]->id)->delete();
            }
        }
    }

    public function editMainImage(Request $request, $id){
        if ($request->has('main_image')){
            //validation
            $request->validate([
                'main_image' => 'image|mimes:png,jpg,jepg',
            ]);

            //delete previous main_image
            $product = Product::find($id);
            if (!$product)
                return 'this is invalid product';
            Storage::delete($product->main_image);
            $new_image = $request->file('main_image')->store('images/products/' . $product->id);
            $product->update(['main_image' => $new_image]);
        }
    }

    public function editSubImages(Request $request, $id){
        if ($request->has('image')){
            //validation
            $request->validate([
                'image' => 'image|mimes:png,jpg,jepg',
            ]);

            //add image to files table and to filesystem
            $path = $request->file('image')->store('images/products/'.$id);
            $image_info = pathinfo($request->image->getClientOriginalName());
            $size = filesize($request->file('image'));
            $file = File::create([
                'file_prev_name' => $image_info['basename'],
                'type' => $image_info['extension'],
                'size' => $size,
                'product_id' => $id,
                'file' => $path,
            ]);
            return response()->json(['id' => $file->id]);
        }
    }

    public function deleteSubImages(Request $request){

        $file = File::find($request->id);
        if (!$file)
            return 'this is invalid image';
        Storage::delete($file->file);
        $file->delete();
    }
}
