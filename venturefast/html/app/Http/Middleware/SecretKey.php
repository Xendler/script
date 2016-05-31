<?php

namespace App\Http\Middleware;

use Closure;

class SecretKey
{
    const SECRET_KEY = '517KccLYMb3a4P3F';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->get('secretKey') != self::SECRET_KEY) return response()->json('Invalid Secret Key');
        return $next($request);
    }
}
