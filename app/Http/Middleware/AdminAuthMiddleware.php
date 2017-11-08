<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null, $route = null)
    {

        // dd($route . " --  ". $guard);
        // dd(Auth::guard("teacher")->guest());
        if (Auth::guard("admin")->guest()) {
            // if ($request->ajax() || $request->wantsJson()) {
                // return response('Unauthorized.', 401);
            // } else {
                return redirect()->guest('admin/login');
            // }
        }
        return $next($request);
    }
}
