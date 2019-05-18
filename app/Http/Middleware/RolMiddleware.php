<?php

namespace App\Http\Middleware;

use Closure;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$rol1=null,$rol2=null,$rol3=null)
    {
        if($request->user()->authorizeRoles((int)$rol1)||$request->user()->authorizeRoles((int)$rol2)||$request->user()->authorizeRoles((int)$rol3)){
            return $next($request);
    }
        abort(401,'Permiso no valido');



    }
}
