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
        $order = Order::where('member_id',$member->id)->latest('updated_at')->first();
        $cart_items = OrderItem::where('order_id',$order->id)->get();


        //cart
        $cartCount = $this->cartCount($request);

        //end cart

        //member


        return view('checkout')
            ->with('cartCount', $cartCount)
            ->with('cart_items', $cart_items)
            ->with('total_price', $order->total_price)
            ->with('order_id', $order->id)
            ->with('special_infos', $order->infos)
            //->with('speicial_infos', $special_infos)
            ->with('member', $member);


    }

    public function toOrderSuccess(Request $request,$order_id)
    {

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

