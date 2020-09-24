@extends('admin.master')
@section('content')

    <div>
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 分类管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="page-container">
            <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a class="btn btn-primary radius" onclick="category_add('添加类别','/admin/unCategory_add')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加次级类别</a></span> <span class="r">共有数据：<strong>{{count($unCategories)}}</strong> 条</span> </div>
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th width="40">ID</th>
                        <th width="100">名称</th>
                        <!--<th width="60">缩略图</th>-->
                        <th width="40">父类别</th>
                        <th>详细说明</th>
                        <th width="60">游戏平台</th>
                        <th width="60">特殊输入内容</th>
                        <th width="60">发货周期</th>
                        <th width="60">利润率</th>
                        <th width="60">状态</th>
                        <th width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($unCategories as $category)
                    <tr class="text-c va-m">
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <!--<td>@if($category->preview != null) <img src="{{$category->preview}}" width="100">@endif</td>-->
                        <td>@if($category->parent != null) {{$category->parent->name}} @endif</td>
                        <td>{{$category->info}}</td>
                        <td>
                            @foreach(explode("|",$category->platform) as $platform)
                                @switch($platform)
                                    @case(1)
                                    PS4
                                    @break

                                    @case(2)
                                    XBOX
                                    @break

                                    @default
                                    PC
                                @endswitch
                            @endforeach
                        </td>
                        <td>{{$category->special_info}}</td>
                        <td>{{$category->delivery_time}}</td>
                        <td>{{$category->margin}}</td>
                        <td class="td-status">
                            @if($category->status != '0')
                            <span class="label label-success radius">
                                    已发布
                                @else
                                    <span class="label label-defaunt radius">
                                    未激活

                            </span>
                            @endif
                        </td>
                        <td class="td-manage">
                            @if($category->status != '0')
                            <a style="text-decoration:none" onClick="category_stop(this,{{$category->id}})" href="javascript:;" title="下架">
                                <i class="Hui-iconfont">&#xe6de;</i>
                            </a>
                            @else
                            <a style="text-decoration:none" onclick="category_start(this,{{$category->id}})" href="javascript:;" title="发布">
                                <i class="Hui-iconfont"></i>
                            </a>
                            @endif
                            <a style="text-decoration:none" class="ml-5" onClick="category_edit('产品编辑','/admin/category_edit/{{$category->id}}')" href="javascript:;" title="编辑">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                            <a style="text-decoration:none" class="ml-5" onClick="category_del(this,'/admin/service/category/del/{{$category->id}}')" href="javascript:;" title="删除">
                                <i class="Hui-iconfont">&#xe6e2;</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('my-js')
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
    <script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">
        var setting = {
            view: {
                dblClickExpand: false,
                showLine: false,
                selectedMulti: false
            },
            data: {
                simpleData: {
                    enable:true,
                    idKey: "id",
                    pIdKey: "pId",
                    rootPId: ""
                }
            },
            callback: {
                beforeClick: function(treeId, treeNode) {
                    var zTree = $.fn.zTree.getZTreeObj("tree");
                    if (treeNode.isParent) {
                        zTree.expandNode(treeNode);
                        return false;
                    } else {
                        //demoIframe.attr("src",treeNode.file + ".html");
                        return true;
                    }
                }
            }
        };

        $('.table-sort').dataTable({
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
            ]
        });
        /*类别-添加*/
        function category_add(title,url){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*产品-下架*/
        function category_stop(obj,id){
            layer.confirm('确认要下架吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: '/admin/service/category/change/status',
                    dataType: 'json',
                    data: {
                        category_id: id,
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
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="category_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">未激活</span>');
                $(obj).remove();
                layer.msg('已下架!',{icon: 5,time:1000});
            });
        }

        /*产品-发布*/
        function category_start(obj,id){
            layer.confirm('确认要发布吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: '/admin/service/category/change/status',
                    dataType: 'json',
                    data: {
                        category_id: id,
                        _token: "{{csrf_token()}}"
                    },
                    error:function(data) {
                        console.log(data.message);
                    },
                });
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="category_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                $(obj).remove();
                layer.msg('已发布!',{icon: 6,time:1000});
            });
        }



        /*产品-编辑*/
        function category_edit(title,url){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }

        /*产品-删除*/
        function category_del(obj,url){
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
