<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function proseslogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $input = $request->all();

        $user = User::where('email', $input['email'])->first();

        if ($user && auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->role == "admin") {
                return redirect('/dashboard');
            } else if (auth()->user()->role == "guru") {
                $guru = Guru::where('npdn', $user->id_user)->first();
                if ($guru && $guru->status == "aktif") {
                    return redirect('/dashboard/guru');
                } else {
                    auth()->logout();
                }
            } else if (auth()->user()->role == "siswa") {
                return redirect('/dashboard/siswa');
            }
        }

        return back()->with('warning', 'Login Failed!!')->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
