<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminLoginMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::guard()->check())
    {
        if(Auth::guard()->user()->level == 1){
            return $next($request);
        }else{
            return redirect('admin/dang-nhap');
        }
    }else{
        return redirect('admin/dang-nhap');
    }
    }
}
