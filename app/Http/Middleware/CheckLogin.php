<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $member = $request->session()->get('member','');

        if(isset($_SERVER['HTTP_REFERER'])) {
            $http_referer = $_SERVER['HTTP_REFERER']; //last url
            if($member == ''){
                return redirect('/login?return_url='.urlencode($http_referer));
            }
        }
        else
        {
            if($member == ''){
                return redirect('/login');
            }
        }


        return $next($request);
    }
}
