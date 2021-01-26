<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\CustomerProduct;
use App\Models\Order;
use Illuminate\Http\Request;
use function App\Helper\getCurrentCustomerId;

class OrderController extends Controller
{
    public function order(OrderRequest $request){
//        return $request->except(['_token', 'payment_method']);
        if ($request->payment_method == 'onDelivery'){
            $customer_id = getCurrentCustomerId();
            $customer_products = CustomerProduct::where('customer_id', $customer_id)->get();
            foreach ($customer_products as $customer_product){
                $data = $request->except(['_token', 'payment_method']);
                $data = array_merge($data, [ 'customer_product_id' =>  $customer_product->id, 'customer_id' => $customer_id]);
                Order::create($data);
            }
            return redirect()->back()->with(['success' => __('admin.order_add_successfully')]);
        }
        else
            return redirect()->back();
    }

    public function getOrders(){
        $orders = Order::where('customer_id', getCurrentCustomerId())->get();
        return view('frontend.orders', compact('orders'));
    }

    public function deleteOrder($id){
        $order = Order::find($id);
        if ( is_null($order) ){
            return redirect()->back()->with(['error' => __('admin.error')]);
        }
        $order->delete();
        return redirect()->back()->with(['error' => __('admin.order_deleted_successfully')]);
    }
}
