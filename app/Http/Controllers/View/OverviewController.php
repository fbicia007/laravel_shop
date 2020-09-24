<?php

namespace App\Http\Controllers\View;


use App\Entity\Category;
use App\Entity\Member;
use App\Entity\Order;
use App\Entity\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class OverviewController extends BaseController
{

    public function overview(Request $request)
    {

        //cart count
        $cartCount = $this->cartCount($request);
        //end cart count

        //member
        $member_tmp = $request->session()->get('member','');
        $member = Member::find($member_tmp->id);
        $orders = Order::where('member_id',$member->id)->get();

        foreach ($orders as $order){
            $order_items = OrderItem::where('order_id',$order->id)->get();
            $order->order_items = $order_items;
            foreach ($order_items as $order_item){
                $order_item->product = json_decode($order_item->pdt_snapshot);
            }
        }

        return view('overview')
            ->with('cartCount', $cartCount)
            ->with('orders', $orders)
            ->with('member', $member);


    }

    private function cartCount(Request $request){

        //cart
        $cart = $request->cookie('cart');

        $cart_arr = ($cart != null ? explode(',', $cart) :array());


        $count = 0;
        foreach ($cart_arr as $value){
            $index = strpos($value, ':');
            $count = (int)substr($value,$index+1)+$count;

        }
        return $count;

        //end cart
    }



}
