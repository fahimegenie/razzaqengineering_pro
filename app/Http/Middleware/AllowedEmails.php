<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllowedEmails
{
    /**
     * Allowed email addresses for admin access
     */
    private const ALLOWED_EMAILS = [
        'fahimalyani73@gmail.com',
        'saifsattar@gmail.com',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // If not logged in, redirect to login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if user's email is in allowed list
        $userEmail = Auth::user()->email;
        
        if (!in_array($userEmail, self::ALLOWED_EMAILS)) {
            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')
                ->with('error', 'Unauthorized access. Your email is not allowed to access the admin panel.');
        }

        return $next($request);
    }
}