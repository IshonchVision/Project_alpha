<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsTeacher
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'teacher') {
            return $next($request);
        }

        // If not teacher, redirect to home with error
        return redirect('/')->with('error', 'Bu sahifaga kirish uchun o\'qituvchi bo\'lishingiz kerak');
    }
}
