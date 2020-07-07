<?php

namespace App\Http\Controllers\Service;


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


}
