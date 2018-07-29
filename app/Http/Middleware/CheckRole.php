<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Response;

class CheckRole
{
    /**
     * Handle an incoming request to check is authenticated user has a specific role.
     * Role can be specified as an id or unique name.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string|int $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (auth()->user()->hasRole($role)) {
            return $next($request);
        }

        return Controller::dataResponse(Response::HTTP_UNAUTHORIZED, trans('labels.unauthorized'));
    }
}
