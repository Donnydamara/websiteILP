<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BasicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('basic.list', [
            'title' => 'Managemen Pengguna',
            'users' => User::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('basic.create', [
            'title' => 'Tambah Pengguna',
            'users' => User::paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
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

        return redirect()->route('basic.index')
            ->with('success', 'Tambah Pengguna Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $basic)
    {
        return view('basic.edit', [
            'title' => 'Edit Pengguna',
            'user' => $basic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, User $basic)
    {
        if ($request->filled('password')) {
            $basic->password = Hash::make($request->password);
        }
        $basic->name = $request->name;
        $basic->last_name = $request->last_name;
        $basic->role = $request->role;
        $basic->email = $request->email;
        $basic->save();

        return redirect()->route('basic.index')->with('success', 'Update Data Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $basic)
    {
        if (Auth::id() == $basic->getKey()) {
            return redirect()->route('basic.index')->with('warning', 'Can not delete yourself!');
        }

        $basic->delete();

        return redirect()->route('basic.index')->with('success', 'Hapus Pengguna Berhasil!');
    }

    /**
     * Reset password to default (12345678) for the specified user.
     *
     * @param  User  $basic
     * @return \Illuminate\Http\Response
     */

    public function resetPassword($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('basic.index')
                ->with('error', 'User not found');
        }

        // Set password default
        $defaultPassword = '12345678';
        $hashedPassword = Hash::make($defaultPassword);

        // Update password user
        $user->update(['password' => $hashedPassword]);

        return redirect()->route('basic.index')
            ->with('success', 'Reset Passowrd Berhasil. Password Defauls: ' . $defaultPassword);
    }
}
