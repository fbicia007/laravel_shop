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

        $member = $request->session()->get('member','');

        return view('home')
            ->with('cartCount', $cartCount)
            ->with('member', $member);
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


        if(Product::where('id',$product_id)->exists()){

            $product = Product::where('id',$product_id)->get();

            $thisCategory = Category::where('id', $product[0]->category_id)->get('name');

            $member = $request->session()->get('member','');

            return view('product')
                ->with('product', $product)
                ->with('thisCategory', $thisCategory)
                ->with('member', $member)
                ->with('cartCount', $cartCount);
        } else {

        }
    }

    public function toCategory(Request $request, $category_id){

        //cart
        $cartCount = $this->cartCount($request);

        //end cart

        $member = $request->session()->get('member','');

        if(Category::where('parent_id', $category_id)->exists()){

            $thisCategory = Category::find($category_id);

            $unCategorys = Category::where('parent_id', $category_id)->where('status','<>',0)->get();

            $ids = array();

            foreach ($unCategorys as $unCategory)
            {

                //array_push($products, Product::where('category_id',$unCategory->id)->get());
                //$products = Product::where('category_id',$unCategory->id)->get();
                array_push($ids, $unCategory->id);

            }

            $products = Product::whereIn('category_id',$ids)->rightJoin('category','product.category_id','=','category.id')->select('product.*','category.margin')->get();

            return view('category')
                ->with('thisCategory', $thisCategory)
                ->with('products', $products)
                ->with('unCategorys', $unCategorys)
                ->with('member', $member)
                ->with('cartCount', $cartCount);
        } else {
            $thisCategory = Category::find($category_id);

            $products = Product::where('category_id',$category_id)->get();


            return view('category')
                ->with('thisCategory', $thisCategory)
                ->with('products', $products)
                ->with('member', $member)
                ->with('cartCount', $cartCount);
        }



    }


}
