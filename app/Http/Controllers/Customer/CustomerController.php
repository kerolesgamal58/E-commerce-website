<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\CountryShipping;
use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use function App\Helper\getCities;
use function App\Helper\getCurrentCustomerId;

class CustomerController extends Controller
{
    public function getShopPage(){
        $products = Product::where('status', 'active')->paginate(PAGINATION_COUNT);
        return view('frontend.shop', compact('products'));
    }

    public function getProductPage($id){
        $product = Product::find($id);
        if (!$product)
            return abort(404);
        return view('frontend.product', compact('product'));
    }

    public function addToCart(Request $request, $id){
        // product validation
        $product = Product::find($id);
        if (!$product)
            return abort(404);
        // quantity validation
        $request->validate(['quantity' => 'required|numeric']);

        // insert to database
        CustomerProduct::create([
            'customer_id' => Auth::guard('customer')->user()->id,
            'product_id' => $id,
            'quantity' => $request->quantity,
        ]);
        return redirect()->back()->with(['success' => __('admin.add_to_cart_successfully_message')]);
    }

    public function getCart(){
        $customer_id = getCurrentCustomerId();
        $customer_products = CustomerProduct::where('customer_id', $customer_id)->get();
        return view('frontend.cart', compact('customer_products'));
    }

    public function deleteProductFromCart($id){
        $customer_id = getCurrentCustomerId();
        $customer_product = CustomerProduct::where('customer_id', $customer_id)->where('id', $id)->delete()  ;
        if (is_null($customer_product)){
            return redirect()->back()->with(['error' => __('admin.error')]);
        }
        return redirect()->back()->with(['success' => __('admin.product_deleted_successfully')]);
    }

    public function updateCart(Request $request){
        $customer_id = getCurrentCustomerId();
        foreach ($request->quantity as $id => $quantity){
            $customer_product = CustomerProduct::where('id', $id)->where('customer_id', $customer_id);
            $data = $customer_product->get();
            if ( is_null($data) ){
                return redirect()->back()->with(['error' => __('admin.error')]);
            }
            $customer_product->update([
                'quantity' => $quantity
            ]);
        }
        return redirect()->back()->with(['success' => __('admin.product_updated_successfully')]);
    }

    public function getCheckout(){
        $customer_id = getCurrentCustomerId();
        $customer = Customer::find($customer_id);
        $customer_products = CustomerProduct::where('customer_id', $customer_id)->get();
        return view('frontend.checkout', compact('customer', 'customer_products'));
    }

    public function getCities(Request $request){
        $cities = City::where('country_id', $request->country_id)->get();
        if (is_null($cities)){
            return response()->json([
                'status' => false,
                'data' => __('admin.error'),
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $cities,
        ]);
    }

    public function getShippingCompanies(Request $request){
        $country = Country::find($request->country_id);
        $shipping_companies = $country->shipping_companies()->select('name_' . LaravelLocalization::getCurrentLocale() . ' as name')->get();
        if (is_null($country)){
            return response()->json([
                'status' => false,
                'data' => __('admin.error'),
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $shipping_companies,
        ]);
    }
}
