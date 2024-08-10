<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;

class Authenticate
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards[0] ?? null)->guest()) {
            return $this->unauthorizedApiResponse([], __('Unauthorized access.'));
        }

        return $next($request);
    }
}

