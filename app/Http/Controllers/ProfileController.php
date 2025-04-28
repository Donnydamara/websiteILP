<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index'); // Mengarahkan ke folder profile
    }

    public function edit()
    {
        return view('profile.edit'); // Menambahkan halaman edit profile
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|different:current_password|nullable_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|same:new_password'
        ]);

        $user = User::findOrFail(Auth::id());
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        // Logika untuk unggah foto profil
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_photos'), $filename);

            // Hapus foto lama jika ada
            if ($user->profile_photo && file_exists(public_path('uploads/profile_photos/' . $user->profile_photo))) {
                unlink(public_path('uploads/profile_photos/' . $user->profile_photo));
            }

            $user->profile_photo = $filename;
        }

        // Logika untuk memperbarui password
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak cocok']);
            }
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
