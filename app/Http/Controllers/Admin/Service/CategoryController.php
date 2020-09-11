<?php

namespace App\Http\Controllers\Admin\Service;


use App\Entity\Category;
use App\Models\MessageResult;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use function MongoDB\BSON\toJSON;


class CategoryController extends BaseController
{

    public function categoryAdd(Request $request) {
        $name = $request->input('name', '');
        $parent_id = $request->input('parent_id', '');
        $preview = $request->input('preview', '');
        $banner = $request->input('banenr', '');
        $banner_text = $request->input('banenr_text', '');
        $delivery_time = $request->input('delivery_time', '');
        $platform = $request->input('platform', '');
        $info = $request->input('info', '');
        $special_info = $request->input('special_info', '');

        $category = new Category();
        $category->name = $name;
        $category->preview = $preview;
        $category->banner = $banner;
        $category->banner_text = $banner_text;
        $category->delivery_time = $delivery_time;
        $category->platform = json_encode($platform);
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
