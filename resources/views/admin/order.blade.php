@extends('admin.master')
@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> </span> <span class="r">共有数据：<strong>{{count($orders)}}</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="70">订单号</th>
                    <th width="60">总价格</th>
                    <th width="100">订单状态</th>
                    <th width="130">创建时间</th>
                    <th width="60">账号信息</th>
                    <th width="70">发货状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="text-c">
                        <td>{{$order->order_no}}</td>
                        <td>{{$order->total_price}} €</td>
                        <td>@if($order->status != 0)
                                <span class="c-success">已付款</span>
                            @else
                                <span class="c-red">未付款</span>
                            @endif
                        </td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->special_info}}</td>
                        <td class="td-status">
                            @if($order->shipped != 0)
                                <span class="label label-success radius">已发货</span>
                            @else
                                <span class="label label-defaunt radius">未发货</span>
                            @endif
                        </td>


                        <td class="td-manage">
                            @if($order->shipped == 0)
                                <a style="text-decoration:none" onClick="shipped(this,{{$order->id}})" href="javascript:;" title="发货">
                                    <i class="Hui-iconfont">&#xe6e1;</i>
                                </a>
                            @endif
                            <a title="订单详细信息" href="javascript:;" onclick="order_details('订单详情','/admin/order_details/{{$order->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe616;</i></a>

                            <a title="删除" href="javascript:;" onclick="order_del(this,{{$order->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('my-js')

    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.table-sort').dataTable({
                "aaSorting": [[ 0, "desc" ]],//默认第几个排序
                "bStateSave": true,//状态保存
                "aoColumnDefs": [
                    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                    {"orderable":false,"aTargets":[5,6]}// 制定列不参与排序
                ]
            });

        });

        /*标注已发货*/
        function shipped(obj,id){
            layer.confirm('确认完成发货吗？',function(index){

                $.ajax({
                    type: 'POST',
                    url: '/admin/service/order/shipped',
                    dataType: 'json',
                    data: {
                        order_id: id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data){
                        $(obj).parents("tr").find(".td-manage").prepend('');
                        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发货</span>');
                        $(obj).remove();
                        layer.msg('已发货!',{icon: 6,time:1000});
                    },
                    error:function(data) {
                        console.log(data.message);
                    },
                });
            });
        }
        /*订单详情*/
        function order_details(title,url){
            layer_show(title,url);
        }
        /*订单-删除*/
        function order_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: '/admin/service/order/del',
                    dataType: 'json',
                    data: {
                        order_id:id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    },
                    error:function(data) {
                        console.log(data.message);
                    },
                });
            });
        }
    </script>
@endsection
