<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
        $token = str_replace('Bearer ', '', $token);
        $admin = Admin::where('token', $token)->first();
        if (!$admin) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
        return $next($request);
    }
}
