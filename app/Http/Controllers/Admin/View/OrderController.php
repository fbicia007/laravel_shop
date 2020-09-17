<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Member;
use App\Entity\Order;
use App\Entity\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class OrderController extends BaseController
{


    public function toOrder(){

        $orders = Order::all();

        return view('admin.order')->with('orders',$orders);
    }

    public function toOrderDetails(Request $request){

        $order_id = $request->order_id;
        $order = Order::find($order_id);

        $order_items = OrderItem::where('order_id',$order_id)->get();
        $order->order_items = $order_items;
        foreach ($order_items as $order_item){
            $order_item->product = json_decode($order_item->pdt_snapshot);
        }
        $member = Member::find($order->member_id);

        return view('admin.order_details')->with('order',$order)->with('member',$member);
    }





}
