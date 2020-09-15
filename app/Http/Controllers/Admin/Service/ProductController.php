<?php

namespace App\Http\Controllers\Admin\Service;


use App\Entity\Product;
use App\Models\MessageResult;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;



class ProductController extends BaseController
{

    public function productAdd(Request $request) {
        $name = $request->input('name', '');
        $category_id = $request->input('category_id', '');
        $preview = $request->input('preview', '');
        $price = $request->input('price', '');
        $platform = $request->input('platform', '');
        $summary = $request->input('summary', '');


        $product = new Product();
        $product->name = $name;
        $product->category_id = $category_id;
        $product->preview = $preview;
        $product->price = $price;
        $product->platform = $platform;
        $product->summary = $summary;

        $product->save();

        $m3_result = new MessageResult();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function changeProductStatus(Request $request){

        $product_id =$request->input('product_id','');
        if($product_id != ''){
            $product = Product::find($product_id);
            if($product->status == 0){
                $product->status = 1;
            }else{
                $product->status = 0;
            }
            $product->save();

            $m3_result = new MessageResult();
            $m3_result->status = 0;
            $m3_result->message = '修改成功';

            return $m3_result->toJson();
        }
    }
    public function productDel(Request $request){

        $product_id = $request->product_id;
        Product::find($product_id)->delete();

        $m3_result = new MessageResult();
        $m3_result->status = 0;
        $m3_result->message = '删除成功';

        return $m3_result->toJson();
    }
    public function productEdit(Request $request){

        $product_id = $request->product_id;
        $name = $request->input('name', '');
        $category_id = $request->input('category_id', '');
        $preview = $request->input('preview', '');
        $price = $request->input('price', '');
        $platform = $request->input('platform', '');
        $summary = $request->input('summary', '');

        $product = Product::find($product_id);
        $product->name = $name;
        $product->preview = $preview;
        $product->category_id = $category_id;
        $product->price = $price;
        $product->platform = $platform;
        $product->summary = $summary;

        $product->save();

        $m3_result = new MessageResult();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

}
