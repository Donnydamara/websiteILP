<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class ThrottleLogin
{
    public function handle($request, Closure $next)
    {
        $email = $request->input('email');

        if ($email) {
            $loginAttempts = Cache::get($email . '_attempts', 0);
            $blockTime = Cache::get($email . '_block_time', 0);

            if ($blockTime && $blockTime > now()->timestamp) {
                // Calculate remaining time in seconds
                $remainingTime = $blockTime - now()->timestamp;

                // Convert remaining time to minutes and seconds for display
                $minutes = floor($remainingTime / 60);
                $seconds = $remainingTime % 60;

                // Set error message in session
                return Redirect::back()->with('error', 'Akun Anda diblokir selama 3 menit karena terlalu banyak percobaan login yang gagal. Silakan coba lagi nanti.')
                    ->with('block_time', $blockTime)
                    ->with('remaining_time', ['minutes' => $minutes, 'seconds' => $seconds]);
            }
        }

        return $next($request);
    }
}
