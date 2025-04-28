<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle.login')->only('login');
    }

    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect('/login')
                ->with('error', 'Akun tidak ditemukan. Silakan coba lagi.');
        } else {
            if (Auth::attempt($credentials)) {
                // Reset login attempts on successful login
                Cache::forget($credentials['email'] . '_attempts');
                Cache::forget($credentials['email'] . '_block_time');

                if (Auth::user()->role == 'admin') {
                    return redirect('/starter')->with('alert', [
                        'title' => 'Anda Berhasil Login',
                        'imageUrl' => 'https://media.tenor.com/nCWov-JgMgUAAAAi/youre-welcome-cute.gif',
                        'imageAlt' => 'Image Alt Text',
                    ]);
                } elseif (Auth::user()->role == 'kader') {
                    return redirect('/jadwal')->with('alert', [
                        'title' => 'Anda Berhasil Login',
                        'imageUrl' => 'https://media.tenor.com/nCWov-JgMgUAAAAi/youre-welcome-cute.gif',
                        'imageAlt' => 'Image Alt Text',
                    ]);
                }
            } else {
                // Increment login attempts on failed login
                $attempts = Cache::increment($request->input('email') . '_attempts', 1);

                if ($attempts >= 3) {
                    // Set block time for 3 minutes
                    Cache::put($request->input('email') . '_block_time', now()->addMinutes(3)->timestamp, now()->addMinutes(3));

                    // Set error message in session
                    return redirect('/login')->with('error', 'Terlalu banyak percobaan login yang gagal. Akun Anda diblokir selama 3 menit.');
                }
            }
        }

        return redirect('/login')
            ->with('error', 'Password Yang Dimasukkan Salah. Silakan coba lagi.');
    }

    public function showregister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Register berhasil dibuat.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
}
