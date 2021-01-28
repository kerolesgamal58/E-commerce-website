<?php

namespace App\Helper;

use App\Models\City;
use App\Models\CustomerProduct;
use App\Models\Department;
use App\Models\File;
use App\Models\MallProduct;
use App\Models\OtherData;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Shipping;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use function MongoDB\BSON\toJSON;

function websiteIcon(){
    return Setting::orderBy('id', 'desc')->select('icon')->get('icon')[0]->icon;
}

function websiteLogo(){
    return Setting::orderBy('id', 'desc')->select('logo')->get('logo')[0]->logo;
}

function load_dep($select = null, $dep_hide = null){
    $all_departments = Department::select(
        'id',
        'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
        'parent_id', 'logo')->get();
    $dep_arr = [];
    foreach ($all_departments as $department){
        $list_arr = new \stdClass();
        if ($select !== null && $select == $department->id){
            $list_arr->state = [
                'opened' => true,
                'selected' => true,
                'disabled' => false
            ];
        }
        if ($dep_hide !== null and $dep_hide == $department->id){
            $list_arr->state = [
                'opened' => false,
                'selected' => false,
                'disabled' => true,
                'hidden' => true
            ];
        }

        $list_arr->id = $department->id;
//        $list_arr->icon = asset('storage/' . $department->logo);
        $list_arr->parent = $department->parent_id == 0 ? '#' : $department->parent_id;
        $list_arr->text = $department->name;
        array_push($dep_arr, $list_arr);
    }
    return json_encode($dep_arr);
}

function delete_department($id){
    $childs_deps = Department::where('parent_id', $id)->get();
    if (!is_null($childs_deps)){
        foreach ($childs_deps as $child){
            delete_department($child->id);
        }
    }
    $parent_dep = Department::find($id);
    Storage::delete($parent_dep->icon);
    $parent_dep->delete();
}

function getParentDeps($dep_id){
    $deps_arr = [];

    do {
        $dep = Department::select('parent_id')->where('id', $dep_id)->first();
        $dep_id = $dep->parent_id;
        if ($dep_id == 0)
            break;

        array_push($deps_arr, $dep_id);
    }
    while (true);
    return $deps_arr;
}

function deleteProduct($id)
{
    $product = Product::find($id);

    if (file_exists(storage_path('app/public/images/products/'.$id)))
        Storage::deleteDirectory('images/products/' . $id);

    Storage::delete($product->main_image);

    foreach (MallProduct::where('product_id', $id)->get() as $mall) {
        $mall->delete();
    }

    foreach ($product->other_data as $data) {
        $data->delete();
    }

    foreach ($product->files as $file){
        $file->delete();
    }

    $product->delete();
}

function copyProductImages($old_product_id, $new_product_id){
    $main_image = Product::find($old_product_id)->main_image;
    Storage::copy($main_image, 'images/products/'.$new_product_id.'/'.basename($main_image));
    $new_main_image = str_replace('images/products/'. $old_product_id, 'images/products/'.$new_product_id, $main_image);
    Product::where('id', $new_product_id)->update(['main_image' => $new_main_image]);
}

function copyProductFiles(File $file, $old_product_id, $new_product_id){
    $old_file_path = $file->file;
    $old_file = $file->makeHidden(['created_at', 'updated_at', 'file', 'product_id'])->toArray();
    $new_file = File::create($old_file);

    //new file path
    $new_file_path = 'images/products/' . $new_product_id . '/' . basename($old_file_path);
    //copy files
    Storage::copy($old_file_path, $new_file_path);
    // copy database
    File::where('id', $new_file->id)->update(['file' => $new_file_path, 'product_id' => $new_product_id]);
}

function getCurrentCustomerId(){
    return Auth::guard('customer')->user()->id;
}

function getNoProductsInCart(){
    $id = getCurrentCustomerId();
    return CustomerProduct::where('customer_id', $id)->count();
}

function calcCartCach(){
    $Customer_id = getCurrentCustomerId();
    $customer_cart = CustomerProduct::where('customer_id', $Customer_id)->get();
    $total_cache = 0.0;
//    $test = $customer_cart[0]->product;
//    return $test->price_offer;
    foreach ($customer_cart as $customer_product){
        $product = $customer_product->product;
        $price_offer = is_null($product->price_offer) ? 0 : $product->price_offer;
        $price_after_offer = $product->price - $price_offer;
        if ($customer_product->product->currency->currency !== 'EGP')
            $price_after_conversion = $price_after_offer * 16.0;
        else
            $price_after_conversion = $price_after_offer;
        $total_cache += ($price_after_conversion * $customer_product->quantity);
    }
    return $total_cache;
}

function getCurrentUserId(){
    return $company_id = Auth::guard('web')->user()->id;
}

function getCurrentShippingCompanyId(){
    $company_id = Auth::guard('web')->user()->id;
    $shipping_company_id = Shipping::select('id')->where('user_id', $company_id)->first()->id;
    return $shipping_company_id;
}
