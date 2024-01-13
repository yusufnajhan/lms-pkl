<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index() 
    {
        return view('login');
    }

    public function authenticate(LoginRequest $request) 
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $credentials['username'])->first();
        if (!$user) {
            return back()->with('loginError', 'Username tidak ditemukan');
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->with('loginError', 'Password salah');
        }

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = $request->user();

            if ($user->idrole === 1) {
                return redirect('/berandaAdmin')->with('success', 'Login berhasil');
            } else if ($user->idrole === 2) {
                return redirect('/berandaGuru')->with('success', 'Login berhasil');
            } else if ($user->idrole === 3) {
                return redirect('/berandaSiswa')->with('success', 'Login berhasil');
            }
   
        };

        return back()->with('loginError', 'Login gagal');

    }

    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
