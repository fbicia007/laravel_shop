@extends('admin.master')
@section('content')
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> </span> <span class="r">订单号：<strong>{{$order->order_no}}</strong></span> </div>
        <div class="mt-20">
            <div class="pd-10">用户姓名：<strong>{{$member->lastName}},{{$member->firstName}}</strong></div>
            <div class="pd-10">用户邮箱：<strong>{{$member->email}}</strong></div>
            <table class="table table-border table-bg table-bordered">
                <thead>
                <tr><th width="20%">商品</th><th>数量</th><th>单价</th></tr>
                </thead>
                <tbody>
                @foreach($order->order_items as $order_item)
                    <tr class="warning">
                        <th>
                            <img src="{{$order_item->product->preview}}" class="align-self-center mr-3" style="width: 64px;">
                            <p class="mt-0">{{$order_item->product->name}}</p>
                        </th>
                        <td>{{$order_item->count}}</td>
                        <td>€{{$order_item->product->price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



@endsection
@section('my-js')

@endsection
