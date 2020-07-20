<?php

namespace App\Http\Controllers\View;



use App\Entity\CartItem;
use App\Entity\Category;
use App\Entity\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CheckoutController extends BaseController
{

    public function checkout(Request $request, $product_ids)
    {
        $cart_items = array();

        $cart = $request->cookie('cart');
        $cart_arr = ($cart != null ? explode(',', $cart) :array());

        foreach ($cart_arr as $key => $value){

            $index = strpos($value, ':');


            $cart_item = new CartItem();
            $cart_item->id = $key;
            $cart_item->product_id = substr($value,0,$index);
            $cart_item->count = (int)substr($value,$index+1);
            $cart_item->product = Product::find($cart_item->product_id);
            $cart_item->category = Category::find($cart_item->product->category_id);
            $cart_item->special_infos = $cart_item->category->special_info;


            if($cart_item->product != null){
                array_push($cart_items, $cart_item);
            }
        }

        $categorys = Category::whereNull('parent_id')->get();

        //cart
        $cartCount = $this->cartCount($request);

        //end cart

        //member
        $member = $request->session()->get('member','');

        return view('checkout')
            ->with('categorys', $categorys)
            ->with('cartCount', $cartCount)
            ->with('cart_items', $cart_items)
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
