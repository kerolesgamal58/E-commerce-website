<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManufactRequest;
use App\Http\Requests\ShippingRequest;
use App\Models\Manufact;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShippingController extends Controller
{
    public function index(){
        $shippings = Shipping::all();
        return view('admin.shipping.showall', compact('shippings'));
    }

    public function create(){
        return view('admin.shipping.create');
    }

    public function store(ShippingRequest $request){
        $data = $request->except(['_token', 'logo']);
        if ($request->has('logo'))
        {
            $path = $request->file('logo')->store('images/shipping');
            $data = array_merge($data, ['logo' => $path]);
        }

        Shipping::create($data);

        return redirect()->route('shipping.showshippings');
    }

    public function edit($id){
        $shipping = Shipping::find($id);
        if (!$shipping)
            return redirect()->route('shipping.showshippings')->with(['error' => 'could not find this shipping']);
        return view('admin.shipping.edit', compact('shipping'));
    }

    public function update(ShippingRequest $request, $id){
        $shipping = Shipping::find($id);
        if (!$shipping)
            return redirect()->route('shipping.showshippings')->with(['error' => 'could not find this shipping']);

        $data = $request->except(['_token', 'logo']);
        if ($request->has('logo')){
            if (!is_null($shipping->logo))
                Storage::delete($shipping->logo);
            $path = $request->file('logo')->store('images/shipping');
            $data = array_merge($data, ['logo' => $path]);
        }

        Shipping::where('id', $id)->update($data);
        return redirect()->route('shipping.showshippings');
    }

    public function delete($id){
        $shipping = Shipping::find($id);
        if (!$shipping)
            return redirect()->route('shipping.showshippings')->with(['error' => 'error']);

        Storage::delete($shipping->icon);
        $shipping->delete();
        return redirect()->route('shipping.showshippings');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $shipping = Shipping::find($id);
            if (!$shipping)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            Storage::delete($shipping->icon);
            $shipping->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The shipping is deleted successfully',
        ]);
    }
}
