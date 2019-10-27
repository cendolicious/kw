<?php

namespace App\Http\Middleware;

use Closure;

class AccessMiddleware
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
        $defaultResp = ["foo" => "bar"];

        if (!$request->hasHeader('Content-Type')){
            return response()->json(['error' => true, 'message' => "Content-Type Header not found"], 401);
        }

        if ($request->header('Content-Type') != "application/json"){
            return response()->json($defaultResp, 200);
        }

        if(!$request->hasHeader('Authorization')) {
            return response()->json(['error' => true, 'message' => "Authorization Header not found"], 401);
        }

        if($request->header('Authorization') == null) {
            return response()->json(['error' => true, 'message' => "No token provided."], 401);
        }

        if($request->header('Authorization') != env("KW_ACCESS_TOKEN")) {
            return response()->json(['error' => true, 'message' => "Token unauthorized."], 401);
        }

        return $next($request);
    }
}
