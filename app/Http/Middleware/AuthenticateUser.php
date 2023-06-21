<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateUser
{

    public function handle(Request $request, Closure $next)
    {
      //dd($request->session()->all())
      //dd($request->session()->has('username'));
      
        if ($request->session()->has('username')) {
            return $next($request);
        }
    
        return redirect('/');
    }
    
}
