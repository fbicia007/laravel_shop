<?php

namespace App\Http\Controllers\Service;


use App\Entity\Category;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use App\Models\MessageResult;


class ProductsController extends Controller
{

    public function getCategoryByCategoryId($category_id)
    {

        $unCategorys = Category::where('parent_id',$category_id)->get();

        if(Category::where('parent_id',$category_id)->exists()){

            $ids = array();

            foreach ($unCategorys as $unCategory)
            {

                array_push($ids, $unCategory->id);

            }

            //with parent category
            $products = Product::whereIn('category_id',$ids)->get();

            $message_result = new MessageResult();
            $message_result->status = 0;
            $message_result->message = 'Result ready.';
            $message_result->products = $products;

        } else {

            //with out parent category
            $products = Product::where('category_id',$category_id)->get();
            $message_result = new MessageResult();
            $message_result->status = 0;
            $message_result->message = 'Result ready.';
            $message_result->products = $products;
        }

        return $message_result->toJson();

    }

    public function getCategoryByCategoryIdAndPlatfomId($category_id,$platform_id)
    {

        $unCategorys = Category::where('parent_id',$category_id)->get();

        if(Category::where('parent_id',$category_id)->exists()){

            $ids = array();

            foreach ($unCategorys as $unCategory)
            {

                array_push($ids, $unCategory->id);

            }

            //with parent category
            $products = Product::whereIn('category_id',$ids)->where('platform',$platform_id)->get();

            $message_result = new MessageResult();
            $message_result->status = 0;
            $message_result->message = 'Result ready.';
            $message_result->products = $products;

        } else {

            //with out parent category
            $products = Product::where('category_id',$category_id)->where('platform',$platform_id)->get();
            $message_result = new MessageResult();
            $message_result->status = 0;
            $message_result->message = 'Result ready.';
            $message_result->products = $products;
        }

        return $message_result->toJson();

    }


}
