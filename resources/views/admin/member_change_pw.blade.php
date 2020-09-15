@extends('admin.master')
@section('content')
    <div class="page-container">
        <form action="" method="post" class="form form-horizontal" id="form-member-add">
            {{ csrf_field() }}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    新密码：</label>
                <div class="formControls col-xs-6 col-sm-6">
                    <input type="password" class="input-text" value="" placeholder="" name="password">
                </div>
            </div>
            <div class="row cl">
                <div class="col-9 col-offset-2">
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </div>

@endsection
@section('my-js')

    <script type="text/javascript">
            //表单验证
            $("#form-member-add").validate({
                rules:{
                    password:{
                        required:true,
                    },

                },
                onkeyup:true,
                focusCleanup:true,
                success:"valid",
                submitHandler:function(form){
                    $(form).ajaxSubmit({
                        type: 'post',
                        url: '/admin/service/member/change/password/{{$member->id}}',
                        dataType: 'json',
                        data: {
                            _token: "{{csrf_token()}}"
                        },
                        success: function (data){
                            if(data == null){
                                layer.msg('服务端错误', {icon:2, time:2000});
                                return;
                            }
                            if(data.status != 0){
                                layer.msg(data.message, {icon:2, time:2000});
                                return;
                            }
                            layer.msg(data.message, {icon:1, time:20000});
                            parent.location.reload();
                        },
                        error: function (xhr, status, error) {
                          console.log(xhr);
                          console.log(status);
                          console.log(error);
                          layer.msg('ajax error', {icon:2, time:2000});
                        },
                        beforeSend: function (xhr) {
                            layer.load(0, {shade: false});
                        },
                    });
                    //var index = parent.layer.getFrameIndex(window.name);
                    //parent.$('.btn-refresh').click();
                    //parent.layer.close(index);
                    return false;
                }
            });
    </script>
@endsection
