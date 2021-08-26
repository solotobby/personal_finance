<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminCreated extends Middleware
{
    /**
     * user is redirected when admin is not setup.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    protected function redirectTo($request)
    {
       $admin = User::where('role', config('role.name.admin'))->first();
        if(!$admin){
            return route('setup.create');
        }
        
    }
}
