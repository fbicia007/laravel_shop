<?php

namespace App\Providers;

use App\Entity\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        //menu category
        $categories = Category::whereNull('parent_id')->where('status','<>',0)->get();

        //end cart
        View::share(['categories'=>$categories]);
    }
}
