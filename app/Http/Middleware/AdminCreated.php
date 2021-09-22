<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class AdminCreated
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = User::where('role', config('role.name.admin'))->first();
        if($admin){
            return $next($request);
        }
        return redirect(route('setup.create'));
        
    }

}
