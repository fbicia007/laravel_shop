<?php

namespace App\Http\Controllers\View;



use App\Entity\CartItem;
use App\Entity\Category;
use App\Entity\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CartController extends BaseController
{

    public function toCart(Request $request)
    {
        $cart_items = array();

        $cart = $request->cookie('cart');
        $cart_arr = ($cart != null ? explode(',', $cart) :array());

        $member = $request->session()->get('member','');

        foreach ($cart_arr as $key => $value){

            $index = strpos($value, ':');


            $cart_item = new CartItem();
            $cart_item->id = $key;
            $cart_item->product_id = substr($value,0,$index);
            $cart_item->count = (int)substr($value,$index+1);
            $cart_item->product = Product::find($cart_item->product_id);
            $cart_item->category = Category::find($cart_item->product->category_id);
            $cart_item->categoryName = $cart_item->category->name;


            if($cart_item->product != null){
                array_push($cart_items, $cart_item);
            }
        }

        $categorys = Category::whereNull('parent_id')->get();

        //cart
        $cartCount = $this->cartCount($request);

        //end cart


        if($member != ''){


            /*offline cart
            //$cart_items = $this->syncCart($member->id, $cart_arr);
            //return response()->view('cart',['cart_items' => $cart_items])->withCookie('cart', null);
            end offline cart */

            return view('cart')
                ->with('categorys', $categorys)
                ->with('cartCount', $cartCount)
                ->with('cart_items', $cart_items)
                ->with('member', $member);

        }

        return view('cart')
            ->with('categorys', $categorys)
            ->with('cartCount', $cartCount)
            ->with('cart_items', $cart_items)
            ->with('member', $member);


    }

    private function syncCart($member_id, $cart_arr){

        $cart_items = CartItem::where('member_id',$member_id)->get();

        $cart_items_arr = array();

        foreach ($cart_arr as $value){
            $index = strpos($value, ':');
            $product_id = substr($value,0,$index);
            $count = (int)substr($value,$index+1);

            //looking for product_id in DB
            $exist = false;
            foreach ($cart_items as $temp){

                if($temp->product_id == $product_id){
                    if($temp->count < $count){
                        $temp->count = $count;
                        $temp->save();
                    }
                    $exist = true;
                    break;
                }
            }
            //Product_id not in DB
            if($exist == false){
                $cart_item = new CartItem();
                $cart_item->member_id = $member_id;
                $cart_item->product_id = $product_id;
                $cart_item->count = $count;
                $cart_item->save();
                array_push($cart_items_arr,$cart_item);

            }

        }

        //product infos for each item
        foreach ($cart_items as $cart_item){
            $cart_item->product = Product::find($cart_item->product_id);
            array_push($cart_items_arr,$cart_item);
        }

        return $cart_items_arr;
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
