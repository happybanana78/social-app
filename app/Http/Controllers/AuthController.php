<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            "username" => "required|unique:users,username",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:5"
        ]);

        User::create([
            "username" => $data["username"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"])
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'username' => 'required',
        ]);
     
        $user = User::where('username', $request->username)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->createToken($request->username)->plainTextToken;
    }
    
}
