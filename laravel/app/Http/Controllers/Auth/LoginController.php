<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller

{
    // use AuthenticatesUsers;
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');

        // Check if the email exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak diketahui',
            ])->withInput($request->only('email'));
        }

        // If email exists, attempt to authenticate with the provided password
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Password salah',
            ])->withInput($request->only('email'));
        }

        // If authentication is successful, redirect to the home route
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     $errors = [];

    //     if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         if (!Auth::attempt(['email' => $request->email])) {
    //             $errors['email'] = 'Email tidak diketahui';
    //         } else {
    //             $errors['password'] = 'Password salah';
    //         }
    //     }

    //     if ($request->expectsJson()) {
    //         return response()->json($errors, 422);
    //     }

    //     return redirect()->back()
    //         ->withInput($request->only('email', 'remember'))
    //         ->withErrors($errors);
    // }
}
