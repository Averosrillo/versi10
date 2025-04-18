<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // Tidak ada middleware lagi
    }

    public function create()
    {
        return view('admin.add-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:siswa,admin,bank',
        ]);        

        if (auth()->user()->role == 'admin') {
            $role = $request->role;
        } elseif (auth()->user()->role == 'bank') {
            $role = 'siswa';
        } else {
            return redirect()->route('home')->with('status', 'Tidak memiliki hak akses untuk menambah pengguna.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('home')->with('status', "Success Add User");
        }

        return redirect()->back()->with('status', "Failed Add User");
    }

    public function edit(User $user)
    {
        return view("admin.edit-user", compact("user"));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $updated = $user->update($data);

        if ($updated) {
            return redirect()->route('home')->with("status", "Success Update User");
        }

        return redirect()->back()->with("status", "Failed Update User");
    }

    public function destroy(User $user)
    {
        $deleted = $user->delete();

        if ($deleted) {
            return redirect()->route('home')->with("status", "Success Delete User");
        }

        return redirect()->back()->with("status", "Failed Delete User");
    }
}
    