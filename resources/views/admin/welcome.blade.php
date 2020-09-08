@extends('admin.master')
@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 欢迎 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="panel panel-default">
            <div class="panel-header">Welcome {{$admin->firstName}} {{$admin->lastName}}</div>
            <div class="panel-body">您可以在此更改网站设置，管理分类，商品，用户等操作。请点击左侧菜单查找相应功能。</div>
        </div>

    </div>

    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">


    </script>
@endsection
