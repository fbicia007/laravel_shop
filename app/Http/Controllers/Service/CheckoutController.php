<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\MessageResult;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{

    public function addOrder(Request $request, $product_id)
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


}
