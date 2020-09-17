<?php

namespace App\Http\Controllers\View;



use App\Entity\CartItem;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Models\MessageEmail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

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

        $order_no = $order->order_no;


        $products = OrderItem::where('order_id',$order_id)->get();

        $cookie = Cookie::queue(\Cookie::forget('cart'));


        //send order to member
        $member = $request->session()->get('member');
        $email = $member->email;
        $message_email = new MessageEmail();
        $message_email->order = $order;
        $message_email->products = $products;
        $message_email->to = $email;
        $message_email->subject = 'Your MMOZONE Games order info:'.$order_no;
        $message_email->member = $member;

        Mail::send(['html' => 'email_order'], ['message_email'=>$message_email], function ($m) use ($message_email){
            $m->from('support@mmozone.de', 'MMOZONE online shop');

            $m->to($message_email->to, 'dear user')
                ->subject($message_email->subject);
        });

        return view('show_order')
            ->with('categories', $categories)
            ->with('cartCount', $cartCount)
            ->with('products', $products)
            ->with('order', $order)
            ->withCookie($cookie);


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

        $order->status = 1;//pay success
        $order->special_info = json_encode($input);
        $order->save();

        //return $order;

        return redirect('/order/success/'.$order_id);


    }



}

