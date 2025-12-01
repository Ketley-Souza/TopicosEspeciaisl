<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class simpleauth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login')->with('error','É preciso entrar para acessar essa página.');
        }
        return $next($request);
    }
}
