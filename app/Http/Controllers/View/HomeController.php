<?php

namespace App\Http\Controllers\View;


use App\Entity\Category;
use App\Entity\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{

    public function toHome(Request $request){

        //cart
        $cartCount = $this->cartCount($request);

        //end cart

        $categorys = Category::whereNull('parent_id')->get();
        return view('home')
            ->with('categorys', $categorys)
            ->with('cartCount', $cartCount);
    }

    private function cartCount(Request $request){

        //cart
        $cart = $request->cookie('cart');

        $cart_arr = ($cart != null ? explode(',', $cart) :array());


        $count = 0;
        foreach ($cart_arr as $value){
            $index = strpos($value, ':');
            $count = (int)substr($value,$index+1)+$count;

        }
        return $count;

        //end cart
    }
    public function toProduct(Request $request, $product_id){

        //cart

        $cartCount = $this->cartCount($request);

        //end cart
        $categorys = Category::whereNull('parent_id')->get();


        if(Product::where('id',$product_id)->exists()){

            $product = Product::where('id',$product_id)->get();

            $thisCategory = Category::where('id', $product[0]->category_id)->get('name');

            return view('product')
                ->with('product', $product)
                ->with('categorys', $categorys)
                ->with('thisCategory', $thisCategory)
                ->with('cartCount', $cartCount);
        } else {

        }
    }

    public function toCategory(Request $request, $category_id){

        //cart
        $cartCount = $this->cartCount($request);

        //end cart

        $categorys = Category::whereNull('parent_id')->get();


        if(Category::where('parent_id', $category_id)->exists()){

            $thisCategory = Category::where('id', $category_id)->get();

            $unCategorys = Category::where('parent_id', $category_id)->get();

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
                        ->with('unCategorys', $unCategorys)
                        ->with('cartCount', $cartCount);
        } else {
            $thisCategory = Category::where('id', $category_id)->get();

            $products = Product::where('category_id',$category_id)->get();
            return view('category')
                ->with('thisCategory', $thisCategory)
                ->with('products', $products)
                ->with('categorys', $categorys)
                ->with('cartCount', $cartCount);
        }



    }


}
