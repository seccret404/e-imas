<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function proseslogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $input = $request->all();

        if(auth()->attempt(array('email' => $input['email'],'password'=>$input['password']))){
            if(auth()->User()->role == "admin"){
                return redirect('/dashboard');
            }else if(auth()->User()->role == "guru"){
                return redirect('/dashboard/guru');
            }else if(auth()->User()->role == "siswa"){
                return redirect('/dashboard/siswa');
            }
            return back()->with('warning', 'Login Faild!!')->onlyInput('email');
        }
    }
    public function logout(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
    }
}
