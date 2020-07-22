<?php

namespace App\Http\Controllers\View;



use App\Entity\CartItem;
use App\Entity\Category;
use App\Entity\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class OverviewController extends BaseController
{

    public function overview(Request $request)
    {
        //for category menu
        $categorys = Category::whereNull('parent_id')->get();
        //end category menu

        //cart count
        $cartCount = $this->cartCount($request);
        //end cart count

        //member
        $member = $request->session()->get('member','');
        $orders = CartItem::where('member_id',$member->id)->get();

        return view('overview')
            ->with('categorys', $categorys)
            ->with('cartCount', $cartCount)
            ->with('orders', $orders->groupBy('order_id'))
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
