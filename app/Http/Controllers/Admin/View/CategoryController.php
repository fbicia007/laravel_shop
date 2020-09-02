<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Category;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{


    public function toCategory(){

        $categories = Category::where('parent_id',null)->get();

        return view('admin.category')->with('categories',$categories);
    }
    public function toUnCategory(){

        $unCategories = Category::whereNotNull('parent_id')->get();

        foreach ($unCategories as $unCategory){
            if($unCategory->parent_id != null && $unCategory->parent_id !=''){
                $unCategory->parent = Category::find($unCategory->parent_id);
            }
        }


        return view('admin.unCategory')->with('unCategories',$unCategories);
    }

    public function toCategoryAdd(){

        $categories = Category::whereNull('parent_id')->get();


        return view('admin.category_add')->with('categories',$categories);
    }




}
