<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Headers
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader("X-Requested-With")) {
            return response()->json(["message"=>"Header X-Requested-With is missing"], 400);
        }
        if ($request->header("X-Requested-With") !== "XMLHttpRequest") {
            return response(["message"=>"X-Requested-With must have value XMLHttpRequest"], 400);
        }
        return $next($request);
    }
}
