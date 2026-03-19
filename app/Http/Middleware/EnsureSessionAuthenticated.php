<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSessionAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }

        if (!in_array(session('user_type'), ['admin', 'guest'], true)) {
            session()->flush();
            return redirect()->route('login');
        }

        return $next($request);
    }
}
