<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
class userApi
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
        $user = JWTAuth::parseToken()->authenticate();
        if($request->id == $user->id){
            return $next($request);    
        }else
        {
            return response()->json(['error','You not have Authorize'], 403);
        }
        
    }
}
