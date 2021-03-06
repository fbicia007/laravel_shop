<?php

namespace App\Http\Controllers\View;


use App\Entity\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class MemberController extends BaseController
{

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

    public function toLogin(Request $request)
    {
        //cart
        $cartCount = $this->cartCount($request);
        //return url
        $return_url = $request->input('return_url');

        //end cart
        return view('login')
            ->with('return_url', urldecode($return_url))
            ->with('member', null)
            ->with('cartCount', $cartCount);

    }

    public function toRegister(Request $request)
    {
        //cart
        $cartCount = $this->cartCount($request);

        //end cart

        return view('register')
            ->with('member', null)
            ->with('cartCount', $cartCount);

    }
    public function toForgot_pw(Request $request)
    {

        //cart
        $cartCount = $this->cartCount($request);

        //end cart
        return view('forgot_pw')
            ->with('member', null)
            ->with('cartCount', $cartCount);

    }
    public function toChange_pw(Request $request)
    {

        //cart
        $cartCount = $this->cartCount($request);

        //end cart
        return view('change_pw')
            ->with('member', null)
            ->with('cartCount', $cartCount);

    }

}
