<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller 
{
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email',],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $request->user();
        }

        return [
            'message' => 'Unknown email and password combination.',
        ];
    }

    public function register(Request $request) {
        $new_credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required']
        ]);

        $user = new User($new_credentials);
        if ($user->save()) {
            return $user;
        } else {
            return [
                'message' => 'Something went horrendously wrong!'
            ];
        };
    }
}