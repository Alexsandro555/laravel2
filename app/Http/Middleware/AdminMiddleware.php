<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware {
    public function handle($request, Closure $next)
    {
        if($request->user()){
             $admin = $request->user()->admin;
            if($admin == 1) {
                return $next($request);
            }
        }
        return redirect('/login');
    }
}