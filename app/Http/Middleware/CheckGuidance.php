<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use auth;
use Illuminate\Http\Request;

class CheckGuidance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Gate::allows('is-guidance-only')){
            return abort(404);
        }
        return $next($request);
    }
}
