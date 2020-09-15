@extends('admin.master')
@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" onclick="member_add('添加用户','/admin/member_add')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong>{{count($members)}}</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="20">ID</th>
                    <th width="90">姓名</th>
                    <th width="100">Email</th>
                    <th width="90">Phone</th>
                    <th width="150">地址</th>
                    <th width="130">创建时间</th>
                    <th width="60">邮箱验证</th>
                    <th width="70">权限</th>
                    <th width="70">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($members as $member)
                <tr class="text-c">
                    <td><input type="checkbox" value="1" name=""></td>
                    <td>{{$member->id}}</td>
                    <td>{{$member->lastName}}, {{$member->firstName}}</td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->phone}}</td>
                    <td>{{$member->street}},{{$member->zip}} {{$member->city}} {{$member->state}}</td>
                    <td>{{$member->created_at}}</td>
                    <td>@if($member->active == 0)
                            未验证
                        @else
                            已验证
                        @endif
                    </td>
                    <td>
                        @if($member->super == 0)
                            普通
                        @else
                        管理员
                        @endif
                    </td>
                    <td class="td-status">
                        @if($member->status != 0)
                            <span class="label label-success radius">已启用</span>
                        @else
                            <span class="label label-defaunt radius">已停用</span>
                        @endif
                    </td>
                    <td class="td-manage">
                        @if($member->status != '0')
                            <a style="text-decoration:none" onClick="member_stop(this,{{$member->id}})" href="javascript:;" title="停用">
                                <i class="Hui-iconfont">&#xe631;</i>
                            </a>
                        @else
                            <a style="text-decoration:none" onClick="member_start(this,{{$member->id}})" href="javascript:;" title="启用">
                                <i class="Hui-iconfont">&#xe6e1;</i>
                            </a>
                        @endif
                        <a title="编辑" href="javascript:;" onclick="member_edit('编辑','/admin/member_edit/{{$member->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','/admin/member_change_password/{{$member->id}}')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a>
                        <a title="删除" href="javascript:;" onclick="member_del(this,'/admin/service/member/del/{{$member->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
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
                "aaSorting": [[ 1, "desc" ]],//默认第几个排序
                "bStateSave": true,//状态保存
                "aoColumnDefs": [
                    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                    {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
                ]
            });

        });
        /*用户-添加*/
        function member_add(title,url){
            layer_show(title,url);
        }

        /*用户-停用*/
        function member_stop(obj,id){
            layer.confirm('确认要停用吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: '/admin/service/member/change/status',
                    dataType: 'json',
                    data: {
                        member_id: id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data){
                        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                        $(obj).remove();
                        layer.msg('已停用!',{icon: 5,time:1000});
                    },
                    error:function(data) {
                        console.log(data.message);
                    },
                });
            });
        }

        /*用户-启用*/
        function member_start(obj,id){
            layer.confirm('确认要启用吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: '/admin/service/member/change/status',
                    dataType: 'json',
                    data: {
                        member_id: id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data){
                        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                        $(obj).remove();
                        layer.msg('已启用!',{icon: 6,time:1000});
                    },
                    error:function(data) {
                        console.log(data.message);
                    },
                });
            });
        }
        /*用户-编辑*/
        function member_edit(title,url){
            layer_show(title,url);
        }
        /*密码-修改*/
        function change_password(title,url){
            layer_show(title,url);
        }
        /*用户-删除*/
        function member_del(obj,url){
            layer.confirm('确认要删除吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {
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
