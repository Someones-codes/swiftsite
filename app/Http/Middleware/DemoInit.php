<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DemoInit
{
    public function handle(Request $request, Closure $next)
    {
        // Assign a unique session ID to this visitor if they don't have one
        if (!session()->has('demo_session_id')) {
            session([
                'demo_session_id' => 'demo_' . uniqid() . '_' . time(),
                'demo_started_at' => now(),
            ]);
        }

        return $next($request);
    }
}