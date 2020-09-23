<?php

namespace App\Http\Controllers\Service;


use App\Entity\CartItem;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use App\Models\MessageResult;
use Illuminate\Http\Request;


class CartController extends Controller
{

    public function addCart(Request $request, $product_id)
    {

        $cart = $request->cookie('cart');

        $cart_arr = ($cart != null ? explode(',', $cart) :array());

        $count = 1;
        foreach ($cart_arr as &$value){
            $index = strpos($value, ':');
            if(substr($value,0,$index) == $product_id){
                $count = ((int)substr($value,$index+1)) +1;
                $value = $product_id.':'.$count;
                break;
            }
        }

        if($count == 1){
            array_push($cart_arr, $product_id.':'.$count);

        }

        $message = new MessageResult();
        $message->status = 0;
        $message->message = 'This item is added to your cart';

        return response($message->toJson())->withCookie('cart',implode(',',$cart_arr));


    }

    public function dashCart(Request $request, $product_id)
    {

        $cart = $request->cookie('cart');

        $cart_arr = ($cart != null ? explode(',', $cart) :array());

        $count = 1;
        foreach ($cart_arr as &$value){
            $index = strpos($value, ':');
            if(substr($value,0,$index) == $product_id){
                $count = ((int)substr($value,$index+1)) -1;
                $value = $product_id.':'.$count;
                break;
            }
        }

        if($count == 1){
            array_push($cart_arr, $product_id.':'.$count);

        }

        $message = new MessageResult();
        $message->status = 0;
        $message->message = 'This item is dash from your cart';

        return response($message->toJson())->withCookie('cart',implode(',',$cart_arr));


    }

    public function deleteCart(Request $request)
    {
        $message = new MessageResult();

        $cartItem_id = $request->input('cartItem_id','');

        if($cartItem_id == ''){
            $message->status = 1;
            $message->message = 'No Item!';
            return $message;
        }
        $cart = $request->cookie('cart');
        $cart_array = ($cart!=null ? explode(',',$cart) : array());
        foreach ($cart_array as $key=>$value) {
            $index = strpos($value, ':');
            $product_id = substr($value,0,$index);

            //search product id in cart
            if($product_id == $cartItem_id){
                array_splice($cart_array,$key,1);
                continue;
            }
        }

        $message->status = 0;
        $message->message = 'Item deletet.';

        return response($message->toJson())->withCookie('cart', implode(',',$cart_array));
    }


    public function checkout(Request $request)
    {
        $message = new MessageResult();

        $member = $request->session()->get('member','');

        //not login
        if($member == ''){
            $message->status = 1;
            $message->message = 'please login.';

            return response($message->toJson());
        }

        $order = new Order();
        $order->member_id = $member->id;
        $order->save();
        $cart_items = array();

        $cart = $request->cookie('cart');
        $cart_arr = ($cart != null ? explode(',', $cart) :array());


        //$special_infos = array();

        $total_price = 0;
        $name ='';

        foreach ($cart_arr as $key => $value){

            $index = strpos($value, ':');


            $cart_item = new CartItem();
            $cart_item->id = $key;
            $cart_item->product_id = substr($value,0,$index);
            $cart_item->count = (int)substr($value,$index+1);
            $cart_item->product = Product::find($cart_item->product_id);
            $cart_item->category = Category::find($cart_item->product->category_id);
            $cart_item->product->margin = $cart_item->category->margin;
            //$cart_item->special_infos = $cart_item->category->special_info;


            if($cart_item->product != null){
                $total_price += $cart_item->product->price * $cart_item->count * $cart_item->product->margin;

                $name .= $cart_item->product->name;

                array_push($cart_items, $cart_item);
                //array_push($special_infos,$cart_item->category->special_info);
                $special_infos = $cart_item->category->special_info.',';

                $order_item = new OrderItem();
                $order_item->order_id = $order->id;
                $order_item->product_id = $cart_item->product_id;
                $order_item->count = $cart_item->count;
                $order_item->pdt_snapshot = json_encode($cart_item->product);
                $order_item->save();
            }

        }


        $order->name = $name;
        $order->total_price = $total_price;
        //$order->infos = json_encode(array_unique($special_infos,SORT_REGULAR));
        $order->infos = $special_infos;
        $order->order_no = 'M'.time().$order->id;
        $order->save();


        $message->status = 0;
        $message->message = 'Item deletet.';

        return response($message->toJson());


    }


}
