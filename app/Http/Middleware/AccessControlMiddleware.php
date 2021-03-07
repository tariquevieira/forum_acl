<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccessControlMiddleware
{
    use AuthorizesRequests;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $ignoreResources = config('accesscontrollist')['ignore.resources'];
        $routeName = $request->route()->getName();
        if(!in_array($routeName,$ignoreResources)){
            $this->authorize($routeName);
        }
        
        return $next($request);
    }
}
