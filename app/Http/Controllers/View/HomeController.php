<?php

namespace App\Http\Controllers\View;


use App\Entity\Category;
use App\Entity\Product;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{

    public function toHome($value=''){

        $categorys = Category::whereNull('parent_id')->get();
        return view('home')->with('categorys', $categorys);
    }
    public function toProduct($product_id){

        $categorys = Category::whereNull('parent_id')->get();
        $product = Product::where('id',$product_id)->get();

        if(Product::where('id',$product_id)->exists()){

            return view('product')
                ->with('product', $product)
                ->with('categorys', $categorys);
        } else {

        }
    }

    public function toCategory($category_id){

        $categorys = Category::whereNull('parent_id')->get();

        $thisCategory = Category::where('id', $category_id)->get();

        $unCategorys = Category::where('parent_id', $category_id)->get();

        if(Category::where('parent_id', $category_id)->exists()){


            $ids = array();

            foreach ($unCategorys as $unCategory)
            {

                //array_push($products, Product::where('category_id',$unCategory->id)->get());
                //$products = Product::where('category_id',$unCategory->id)->get();
                array_push($ids, $unCategory->id);

            }

            $products = Product::whereIn('category_id',$ids)->get();


            return view('category')
                        ->with('thisCategory', $thisCategory)
                        ->with('categorys', $categorys)
                        ->with('products', $products)
                        ->with('unCategorys', $unCategorys);
        } else {
            $products = Product::where('category_id',$category_id)->get();
            return view('category')
                ->with('thisCategory', $thisCategory)
                ->with('products', $products)
                ->with('categorys', $categorys);
        }


    }


}
