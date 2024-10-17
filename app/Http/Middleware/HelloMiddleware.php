<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hello = 'Hello! This is Middleware!';
        $bye = 'Good-bye, Middleware...';
        $data = [
            'hello' => $hello,
            'bye' => $bye,
        ];
        $request->merge($data);
        return $next($request);
    }
}
