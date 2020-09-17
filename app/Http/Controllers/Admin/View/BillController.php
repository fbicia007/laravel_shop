<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Order;
use Illuminate\Routing\Controller as BaseController;

class BillController extends BaseController
{



    public function toBill(){

        $orders = Order::all();
        $priceSum = Order::sum('total_price');
        return view('admin.bill')->with('orders',$orders)->with('priceSum',$priceSum);
    }




}
