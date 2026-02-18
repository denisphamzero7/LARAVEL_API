<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // echo 'Kiểm tra đăng nhập admin ở đây';
        if(!$this->islogin()){
            //chuyển hướng về trang login
            return redirect(route('home'));
        }
        if ($request->is('admin/*')|| $request->is('admin')){
            echo '<h3> Khu vực quản trị</h3>';
        }
        return $next($request);
    }
    public function islogin(){
        return true;
    }
}