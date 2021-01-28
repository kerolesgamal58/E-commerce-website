<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;
use function App\Helper\getCurrentShippingCompanyId;
use function App\Helper\getCurrentUserId;

class CompanyController extends Controller
{
    public function index(){
        $user_id = getCurrentUserId();
        $shipping_company_id = getCurrentShippingCompanyId();
        if ( empty($shipping_company_id) )
            $orders = null;
        else
            $orders = Order::where('shipping_company_id', $shipping_company_id)->paginate(PAGINATION_COUNT);

        $notifications = Notification::where('user_id', $user_id)->paginate(PAGINATION_NOTIFICATION);
        return view('company.home', compact('orders', 'notifications'));
    }

    public function markAsRead(Request $request){
        $user_id = getCurrentUserId();
        $notifications = Notification::where('id', $request->id)->where('user_id', $user_id);
        if ( $notifications->count() > 0 ){
            Notification::where('id', $request->id)->where('user_id', $user_id)->update(['read' => 'read']);
            return response()->json([
                'status' => true,
                'message' => 'updated successfully',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'error',
        ]);
    }

    public function checkNotification(Request $request){
        $user_id = getCurrentUserId();
        $notification = Notification::where('user_id', $user_id)->where('sent', 0)->first();
        if ( $notification->count() > 0 ){
            Notification::where('user_id', $user_id)->where('sent', 0)->update([ 'sent' => 1 ]);
            return response()->json([
                'status' => true,
                'notification' =>  $notification,
            ]);
        }
        else
            return response()->json([
                'status' => false,
            ]);
    }
}
