<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsMember
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->is_admin == 0) {
            return $next($request);
        }
        return redirect()->route('dashboard.index');
    }
}
