<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'Email not found']);
        }

        $token = md5(uniqid(rand(), true)); // Generate unique token
        $user->reset_password_token = $token;
        $user->reset_password_token_expires_at = now()->addHour(); // Set token expiration time (1 hour from now)
        $user->save();

        // Send reset password email to the user
        $data = [
            'user' => $user,
            'token' => $token,
        ];
        Mail::send('auth.reset_password_email', $data, function ($message) use ($user) {
            $message->to($user->email)->subject('Reset Password');
        });

        return redirect()->route('password.request')->with('status', 'Reset password link has been sent to your email');
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset_password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)
            ->where('reset_password_token', $request->token)
            ->where('reset_password_token_expires_at', '>', now())
            ->first();

        if (!$user) {
            return redirect()->route('password.reset', ['token' => $request->token])->withErrors(['email' => 'Invalid token or expired']);
        }

        $user->password = Hash::make($request->password);
        $user->reset_password_token = null;
        $user->reset_password_token_expires_at = null;
        $user->save();

        return redirect()->route('password.success');
    }
}
