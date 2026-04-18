<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordController extends Controller
{
    public function edit($username)
    {
        if (auth()->user()->username !== $username) { abort(403); }
        return view('profileedit2');
    }

    public function update(Request $request, $username)
    {
        if (auth()->user()->username !== $username) { abort(403); }

        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.show', $user->username);
    }
}
