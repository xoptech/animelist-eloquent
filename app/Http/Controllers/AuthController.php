<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = $request->login;
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $login, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors(['login' => 'Incorrect username or password'])->onlyInput('login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('username') || $errors->has('email')) {
                return back()->withErrors(['login' => 'Already taken'])->withInput();
            }
            return back()->withErrors(['password' => 'Password must be at least 8 characters'])->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Auth::login($user);

        return redirect('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
