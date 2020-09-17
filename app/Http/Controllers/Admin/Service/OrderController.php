<?php

namespace App\Http\Controllers\Admin\Service;


use App\Entity\Order;
use App\Models\MessageResult;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;



class OrderController extends BaseController
{

    public function changeOrderStatus(Request $request){

        $order_id =$request->input('order_id','');

        if($order_id != ''){
            $order = Order::find($order_id);
            if($order->shipped == 0){
                $order->shipped = 1;
            }
            $order->save();

            $m3_result = new MessageResult();
            $m3_result->status = 0;
            $m3_result->message = '修改成功';

            return $m3_result->toJson();
        }
    }
    public function delOrder(Request $request){

        $order_id =$request->input('order_id','');

        if($order_id != ''){
            $order = Order::find($order_id);
            $order->delete();

            $m3_result = new MessageResult();
            $m3_result->status = 0;
            $m3_result->message = '删除成功';

            return $m3_result->toJson();
        }
    }

}
