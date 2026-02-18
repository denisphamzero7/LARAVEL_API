<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response;
class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function redirectTo(Request $request)
    {
      if(!$request->expectsJson()){
         $currentMiddleware = $request->route()->middleware();
         if(!empty($currentMiddleware) && in_array('auth:doctor',$currentMiddleware)){
             return route('doctors.login');
         }

            return route('login');
      }
    }
}
