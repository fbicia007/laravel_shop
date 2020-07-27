<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Category;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{


    public function toCategory(){

        $categories = Category::all();

        foreach ($categories as $category){
            if($category->parent_id != null && $category->parent_id !=''){
                $category->parent = Category::find($category->parent_id);
            }
        }

        return view('admin.category')->with('categories',$categories);
    }

    public function toCategoryAdd(){

        $categories = Category::whereNull('parent_id')->get();


        return view('admin.category_add')->with('categories',$categories);
    }




}
