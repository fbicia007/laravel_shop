<?php

namespace App\Http\Controllers\Admin\View;


use App\Entity\Category;
use Illuminate\Http\Request;
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
                $unCategory->platform = $unCategory->parent->platform;
            }
        }


        return view('admin.unCategory')->with('unCategories',$unCategories);
    }

    public function toCategoryAdd(){

        return view('admin.category_add');
    }
    public function toCategoryEdit(Request $request){

        $category_id = $request->category_id;
        $category = Category::find($category_id);
        if($category->parent_id != null){

            $parent_categories = Category::whereNull('parent_id')->get();

            return view('admin.category_edit')->with('category',$category)->with('parent_categories',$parent_categories);
        } else {
            $category->platform = explode('|',$category->platform);
            return view('admin.category_edit')->with('category',$category);
        }
    }
    public function toUnCategoryAdd(){

        $categories = Category::whereNull('parent_id')->get();


        return view('admin.unCategory_add')->with('categories',$categories);
    }




}
