<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Category;
use App\Entity\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{


    public function toProduct(){

        $products = Product::all();

        foreach ($products as $product){
            $product->category = Category::find($product->category_id);
        }

        return view('admin.product')->with('products',$products);
    }

    public function toProductAdd(){

        $parent_id = Category::distinct('parent_id')->whereNotNull('parent_id')->pluck('parent_id');
        $categories = Category::whereNotIn('id',$parent_id)->get();

        return view('admin.product_add')->with('categories',$categories);
    }

    public function toProductEdit(Request $request){

        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $parent_id = Category::distinct('parent_id')->whereNotNull('parent_id')->pluck('parent_id');
        $parent_categories = Category::whereNotIn('id',$parent_id)->get();


        return view('admin.product_edit')
            ->with('product',$product)
            ->with('parent_categories',$parent_categories);
    }








}
