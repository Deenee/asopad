<?php

namespace App\Http\Middleware;

use Closure;

class IsEmailVerifiedMiddleware
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
        $user = request()->user();
        if($user && $user->email_status !== 'verified')
        {
            return response()->json(['responseMessage'=>'Email Not verified', 'responseCode'=>'400', 'data'=>[]]);
        }
        return $next($request);
    }
}
