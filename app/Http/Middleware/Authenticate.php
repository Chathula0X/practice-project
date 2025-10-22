<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string{
        if (! $request->expectsJson()){

            if ($request->route() && in_array('auth:admins', $request->route()->middleware())){
                return route('admin.login');
            }

            return route('login');
        }

        return null;
    }
   
}
