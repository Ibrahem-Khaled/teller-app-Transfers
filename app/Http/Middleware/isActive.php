<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isActive
{

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->status == 0) {
            return redirect()->route('payment.page')->with('error', 'حسابك غير نشط. يرجى التواصل مع الادارة.');
        }
        return $next($request);
    }
}
