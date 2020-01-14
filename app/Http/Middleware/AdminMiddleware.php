<?php

namespace ProjectApp\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use ProjectApp\role;

class AdminMiddleware
{
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @return mixed
//      */
//     public function handle($request, Closure $next)
//     {
//         if(Auth::user()->roles()->attach(role::where('name', 'user')->first()))
//         {
//             return $next($request);
//         }else
//         {
//             return redirect('/dashboard'); 
//         }
        
//     }
}
