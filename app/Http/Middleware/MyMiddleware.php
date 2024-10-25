<?php

namespace App\Http\Middleware;

use App\Facades\MyService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // before処理
        $id = rand();
        MyService::setId($id);
        $merge_data = [
            'id' => $id,
            'msg' => MyService::getMsg(),
            'data' => MyService::getData(),
        ];
        $request->merge($merge_data);
        $response = $next($request);

        //after処理
        $content = $response->content();
        $content .= '<style>body {background-color:#eef;}</style>';
        $response->setContent($content);
        return $response;
    }
}
