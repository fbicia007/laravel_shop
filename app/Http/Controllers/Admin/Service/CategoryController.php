<?php

namespace App\Http\Controllers\Admin\Service;


use App\Entity\Category;
use App\Models\MessageResult;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;



class CategoryController extends BaseController
{

    public function categoryAdd(Request $request) {
        $name = $request->input('name', '');
        $parent_id = $request->input('parent_id', '');
        $preview = $request->input('preview', '');
        $banner = $request->input('banner', '');
        $banner_text = $request->input('banner_text', '');
        $delivery_time = $request->input('delivery_time', '');
        $margin = $request->input('margin', '');
        $platform = $request->input('platform', '');
        $info = $request->input('info', '');
        $special_info = $request->input('special_info', '');

        $category = new Category();
        $category->name = $name;
        $category->preview = $preview;
        $category->banner = $banner;
        $category->banner_text = $banner_text;
        $category->delivery_time = $delivery_time;
        if($margin == ''){
            $category->margin = 1;
        }else{
            $category->margin = $margin;
        }
        if($platform !=''){
            $category->platform = implode('|',$platform);
        }
        $category->info = $info;
        $category->special_info = $special_info;
        if($parent_id != '') {
            $category->parent_id = $parent_id;
        }
        $category->save();

        $m3_result = new MessageResult();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function changeCategoryStatus(Request $request){

        $category_id =$request->input('category_id','');
        if($category_id != ''){
            $category = Category::find($category_id);
            if($category->status == 0){
                $category->status = 1;
            }else{
                $category->status = 0;
            }
            $category->save();

            $m3_result = new MessageResult();
            $m3_result->status = 0;
            $m3_result->message = '修改成功';

            return $m3_result->toJson();
        }
    }
    public function categoryDel(Request $request){

        $category_id = $request->category_id;
        Category::find($category_id)->delete();

        $m3_result = new MessageResult();
        $m3_result->status = 0;
        $m3_result->message = '删除成功';

        return $m3_result->toJson();
    }
    public function categoryEdit(Request $request){

        $category_id = $request->category_id;
        $name = $request->input('name', '');
        $parent_id = $request->input('parent_id', '');
        $preview = $request->input('preview', '');
        $banner = $request->input('banner', '');
        $banner_text = $request->input('banner_text', '');
        $delivery_time = $request->input('delivery_time', '');
        $margin = $request->input('margin', '');
        $platform = $request->input('platform', '');
        $info = $request->input('info', '');
        $special_info = $request->input('special_info', '');

        $category = Category::find($category_id);
        $category->name = $name;
        $category->preview = $preview;
        $category->banner = $banner;
        $category->banner_text = $banner_text;
        $category->delivery_time = $delivery_time;
        if($margin == ''){
            $category->margin = 1;
        }else{
            $category->margin = $margin;
        }


        if($platform !=''){
            $category->platform = implode('|',$platform);
        }
        $category->info = $info;
        $category->special_info = $special_info;
        if($parent_id != '') {
            $category->parent_id = $parent_id;
        }
        $category->save();

        $m3_result = new MessageResult();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

}
