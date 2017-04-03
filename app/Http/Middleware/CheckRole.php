<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() === null) {
          return redirect()->action('MainController@Index')->withErrors('The user was not found.');
          //return response("Insufficient permissions.", 401);
        }
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;
        if ($request->user()->hasAnyRole($roles) || !$roles) {
          return $next($request);
        }
        return redirect()->action('MainController@Index')->withErrors('You do not have permission to access the requested page.');
        //return response("Insufficient permissions.", 401);
    }
}
