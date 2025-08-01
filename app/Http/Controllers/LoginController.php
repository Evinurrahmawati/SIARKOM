<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('login-form'); // Ganti sesuai nama file Blade-mu
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // Ambil user berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Cek user dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Simpan data ke session
            session([
                'user_id'    => $user->id,
                'user_name'  => $user->name,
                'user_role'  => $user->role,
                'user_email' => $user->email,
            ]);

            // Redirect ke dashboard umum
            return redirect('/dashboard');
        }

        // Jika gagal login
        return back()->withErrors(['login' => 'Username atau password salah.']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/login');
    }
}
