<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLists;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Order List
    public function OrderList() {
        $Order = Order::select('orders.*','users.name as user_name')
        ->leftjoin('users','orders.user_id','users.id')
        ->orderBy('orders.created_at','desc')
        ->get();
        return view('Admin.Order.OrderLists',compact('Order'));
    }

    //Order Status
    public function OrderStatus(Request $request) {

        $Order = Order::select('orders.*','users.name as user_name')
        ->leftjoin('users','orders.user_id','users.id')
        ->orderBy('orders.created_at','desc');

        if($request->statusValue == '') {
            $Order = $Order->get();

        } else {
            $Order = $Order->where('orders.status',$request->statusValue)->get();
        };

        return view('Admin.Order.OrderLists',compact('Order'));

    }

    //Order Status Change
    public function OrderStatusChange(Request $request) {
        Order::where('id',$request->orderId)->update([ 'status' => $request->status ]);
    }

    //Order Detail List
    public function OrderDetailList($orderCode) {
        $Order = Order::where('order_code',$orderCode)->first();
        $OrderLists = OrderLists::select('order_lists.*','products.name as product_name','products.image as product_image','users.name as user_name')
                                ->leftjoin('users','order_lists.user_id','users.id')
                                ->leftjoin('products','order_lists.product_id','products.id')
                                ->where('order_code',$orderCode)
                                ->paginate('3');


                                return view('Admin.Order.OrderDetailList',compact('OrderLists','Order'));


    }
}
