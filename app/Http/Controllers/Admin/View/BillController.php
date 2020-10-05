<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Order;
use App\Entity\OrderItem;
use Illuminate\Routing\Controller as BaseController;

class BillController extends BaseController
{



    public function toBill(){

        $orderItems = OrderItem::rightJoin('order','order_item.order_id','=','order.id')->get();

        $totalIncomingPrice = 0;
        foreach ($orderItems as $orderItem)
        {
            $orderItem->product = json_decode($orderItem->pdt_snapshot);
            $totalIncomingPrice = $totalIncomingPrice + $orderItem->product->price;
        }

        $orders = Order::all();
        $priceSum = Order::sum('total_price');
        return view('admin.bill')
            ->with('orders',$orders)
            ->with('orderItems',$orderItems)
            ->with('totalIncomingPrice',$totalIncomingPrice)
            ->with('priceSum',$priceSum);
    }




}
