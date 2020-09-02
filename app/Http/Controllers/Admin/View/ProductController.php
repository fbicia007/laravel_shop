<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Category;
use App\Entity\Product;
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








}
