<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin {
    public function handle($request, Closure $next) {
        if(!Auth::check()) {
            session()->flash('error', 'Log In First');
            return redirect('admin/login');
        }

        return $next($request);
    }
}
