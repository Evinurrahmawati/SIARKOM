<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user (hanya role operator)
    public function index()
    {
        $users = User::where('role', 'operator')->get();
        return view('admin.daftar-operator', compact('users'));
    }

    // Menampilkan form tambah operator
    public function create()
    {
        return view('admin.tambah-operator');
    }

    // Menyimpan operator baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'operator',
        ]);

        return redirect()->route('admin.daftar-operator')->with('success', 'Operator berhasil ditambahkan!');
    }

    // Menampilkan form edit operator
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-operator', compact('user'));
    }

    // Menyimpan perubahan data operator
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.daftar-operator')->with('success', 'Data operator berhasil diperbarui!');
    }

    // Menghapus operator
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hanya boleh hapus role operator
        if ($user->role === 'operator') {
            $user->delete();
            return redirect()->route('admin.daftar-operator')->with('success', 'Operator berhasil dihapus!');
        }

        return redirect()->route('admin.daftar-operator')->with('error', 'Hanya operator yang dapat dihapus!');
    }
}
