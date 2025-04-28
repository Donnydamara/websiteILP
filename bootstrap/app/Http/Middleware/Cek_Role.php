<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Cek_Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRole = (string) Auth::user()->role;

            // Cek apakah peran pengguna termasuk dalam peran yang diizinkan
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        // Jika peran pengguna tidak diizinkan, redirect ke halaman landing page
        return redirect('/');
    }
}
