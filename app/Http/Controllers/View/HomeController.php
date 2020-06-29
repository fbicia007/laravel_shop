<?php

namespace App\Http\Controllers\View;


use App\Entity\Category;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{

    public function toHome($value=''){

        $categorys = Category::whereNull('parent_id')->get();
        return view('home')->with('categorys', $categorys);
    }


}
