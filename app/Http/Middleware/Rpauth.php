<?php

namespace App\Http\Middleware;

use App\Models\remember_token;
use Closure;
use Illuminate\Http\Request;

class Rpauth
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
        if ($request->hasHeader("token")) {
            $remember = remember_token::where("token", $request->header("token"))->first();
            if (!empty($remember)) {
                $request->merge(["user" => $remember->user]);
                return $next($request);
            } else {
                return abort(403, "Token is wrong");
            }
        }
        return abort(403, "Token is Require");
    }
}
