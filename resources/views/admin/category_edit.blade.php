@extends('admin.master')
@section('content')
    <div class="page-container">
        <form action="" method="post" class="form form-horizontal" id="form-category-add">
            {{ csrf_field() }}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    分类名称：</label>
                <div class="formControls col-xs-6 col-sm-6">
                    <input type="text" class="input-text" value="{{$category->name}}" name="name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    缩略图：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="uploader-thum-container">
                        @if($category->preview != null)
                        <img id="preview_id" src="{{$category->preview}}" class="img-responsive" style="width: 100px" alt="预览">
                        @else
                            <img id="preview_id" src="http://placehold.jp/99ccff/003366/150x150.png?text=%E7%BC%A9%E7%95%A5%E5%9B%BE%E5%A4%A7%E5%B0%8F%E5%B0%BA%E5%AF%B8%E4%B8%BA%E6%AD%A3%E6%96%B9%E5%BD%A2%EF%BC%8C%E6%96%87%E4%BB%B6%E8%A6%81%E5%B0%8F%E4%BA%8E1%E5%85%86" class="img-responsive" style="width: 100px" alt="预览">
                        @endif
                        <span class="btn-upload">
                          <button class="btn btn-primary radius btn-upload"><i class="Hui-iconfont">&#xe642;</i> 选择图片</button>
                          <input type="file" name="file" id="preview_input" class="input-file" onchange="return uploadImageToServer('preview_input','preview','preview_id')">
                        </span>
                    </div>
                </div>
            </div>
            @if($category->parent_id == null)
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">Banner </br>(图片分辨率比例1200x300)：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="uploader-thum-container">
                        @if($category->banner != null)
                        <img id="banner_id" src="{{$category->banner}}" class="img-responsive" style="width: 400px" alt="响应式图片">
                        @else
                        <img id="banner_id" src="http://placehold.jp/99ccff/003366/400x100.png?text=1200x300" class="img-responsive" style="width: 400px" alt="响应式图片">
                        @endif
                        <span class="btn-upload">
                          <button class="btn btn-primary radius btn-upload"><i class="Hui-iconfont">&#xe642;</i> 选择图片</button>
                          <input type="file" name="file" id="banner_input" class="input-file" onchange="return uploadImageToServer('banner_input','banner','banner_id')">
                        </span>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    Banner 文字描述：</label>
                <div class="formControls col-xs-6 col-sm-6">
                    <input type="text" class="input-text" value="{{$category->banner_text}}" placeholder="" name="banner_text">
                </div>
            </div>
            @endif
            @if(isset($parent_categories))
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">父类：</label>
                <div class="formControls col-xs-6 col-sm-6"> <span class="select-box">
				<select name="parent_id" class="select">
					<option value="">无</option>
                    @foreach($parent_categories as $parent_category)
                        @if($parent_category->id == $category->parent_id)
                            <option value="{{$parent_category->id}}" selected="selected">{{$parent_category->name}}</option>
                        @else
                            <option value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                        @endif
                    @endforeach
				</select>
				</span> </div>
            </div>
            @endif
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    发货时间：</label>
                <div class="formControls col-xs-6 col-sm-6">
                    <input type="text" class="input-text" value="{{$category->delivery_time}}" placeholder="" name="delivery_time">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    发利润率：</label>
                <div class="formControls col-xs-6 col-sm-6">
                    <input type="text" class="input-text" value="{{$category->margin}}" placeholder="" name="margin">
                </div>
            </div>
            @if($category->platform != null)
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    游戏平台：</label>
                <div class="formControls col-xs-6 col-sm-6 required">
                    <div class="check-box required">
                        <input type="checkbox" name="platform[]" value="1" @if(in_array(1,$category->platform)) checked @endif>
                        <label for="checkbox-1">PS4</label>
                    </div>
                    <div class="check-box">
                        <input type="checkbox" name="platform[]" value="2" @if(in_array(2,$category->platform)) checked @endif>
                        <label for="checkbox-2">XBOX</label>
                    </div>
                    <div class="check-box">
                        <input type="checkbox" name="platform[]" value="3" @if(in_array(3,$category->platform)) checked @endif>
                        <label for="checkbox-3">PC</label>
                    </div>
                </div>
            </div>
            @endif
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">
                    <span class="c-red">*</span>
                    详细描述：</label>
                <div class="formControls col-xs-6 col-sm-6">
                    <textarea name="info" cols="" rows="" class="textarea"  placeholder="详细描述...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)">{{$category->info}}</textarea>
                    <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">需要用户提交的特殊信息：</label>
                <div class="formControls col-xs-6 col-sm-6">
                    <textarea name="special_info" cols="" rows="" class="textarea"  placeholder="请在此依次写入用户需要提交的内容，用逗号隔开。举例：例如fifa需要用户提交账号和密码。FIFA Username, FIFA Password" onKeyUp="$.Huitextarealength(this,100)">
                        {{$category->special_info}}
                    </textarea>
                    <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
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
            $("#form-category-add").validate({
                rules:{
                    name:{
                        required:true,
                    },
                    preview:{
                        required:true,
                    },
                    'platform[]':{
                        required:true,
                    },
                    info:{
                        required:true,
                    },

                },
                onkeyup:true,
                focusCleanup:true,
                success:"valid",
                submitHandler:function(form){
                    $(form).ajaxSubmit({
                        type: 'post',
                        url: '/admin/service/category/edit/{{$category->id}}',
                        dataType: 'json',
                        data: {
                            //preview: $('#preview_id').attr('src'),
                            preview: ($('#preview_id').attr('src')!='http://placehold.jp/99ccff/003366/150x150.png?text=%E7%BC%A9%E7%95%A5%E5%9B%BE%E5%A4%A7%E5%B0%8F%E5%B0%BA%E5%AF%B8%E4%B8%BA%E6%AD%A3%E6%96%B9%E5%BD%A2%EF%BC%8C%E6%96%87%E4%BB%B6%E8%A6%81%E5%B0%8F%E4%BA%8E1%E5%85%86'?$('#preview_id').attr('src'):''),
                            banner: ($('#banner_id').attr('src')!='http://placehold.jp/99ccff/003366/400x100.png?text=1200x300'?$('#banner_id').attr('src'):''),
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
