<?php

namespace App\Http\Controllers\View;



use App\Entity\CartItem;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends BaseController
{
    public function checkout(Request $request)
    {
        $member = $request->session()->get('member','');
        $order = new Order();
        $order->member_id = $member->id;
        $order->save();
        $cart_items = array();

        $cart = $request->cookie('cart');
        $cart_arr = ($cart != null ? explode(',', $cart) :array());


        $special_infos = array();

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
            //$cart_item->special_infos = $cart_item->category->special_info;


            if($cart_item->product != null){
                $total_price += $cart_item->product->price * $cart_item->count;

                $name .= $cart_item->product->name;

                array_push($cart_items, $cart_item);
                array_push($special_infos,$cart_item->category->special_info);

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
        $order->infos = json_encode(array_unique($special_infos,SORT_REGULAR));
        $order->order_no = 'M'.time().$order->id;
        $order->save();

        $categories = Category::whereNull('parent_id')->get();

        //cart
        $cartCount = $this->cartCount($request);

        //end cart

        //member


        return view('checkout')
            ->with('categories', $categories)
            ->with('cartCount', $cartCount)
            ->with('cart_items', $cart_items)
            ->with('total_price', $total_price)
            ->with('order_id', $order->id)
            ->with('speicial_infos', array_unique($special_infos,SORT_REGULAR))
            //->with('speicial_infos', $special_infos)
            ->with('member', $member);


    }

    public function toOrderSuccess(Request $request,$order_id)
    {

        //return $request;
        $categories = Category::whereNull('parent_id')->get();

        //cart
        $cartCount = null;
        //end cart

        $order = Order::find($order_id);

        $products = OrderItem::where('order_id',$order_id)->get();

        //$product_test = json_decode('{"id":1,"name":"100K","summary":"Safe FUT 20 Coins blitz send to your account","price":"9.17","preview":"fut.jpeg","category_id":8,"platform":1,"created_at":"2020-06-30T20:31:22.000000Z","updated_at":null}');
        $product_test = ('{"id":13,"name":"Chaos Orb","summary":"Standard Server","price":"0.80","preview":"","category_id":12,"platform":1,"created_at":"2020-07-05T20:28:33.000000Z","updated_at":null}');

        //return $order;



        //$cookie = Cookie::queue(\Cookie::forget('cart'));


        return view('show_order')
            ->with('categories', $categories)
            ->with('cartCount', $cartCount)
            ->with('products', $products)
            ->with('order', $order);
            //->withCookie($cookie);


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

    public function afterPay(Request $request)
    {

        //email
        //显示订单信息
        $input = $request->except('_token');

        $order_id = $request->order_id;

        $order = Order::find($order_id);

        $order->status = 0;//pay success
        $order->special_info = json_encode($input);
        $order->save();

        //return $order;

        return redirect('/order/success/'.$order_id);


    }



}

