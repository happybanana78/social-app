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

    public function changeProfile(Request $request) {
        $user = User::find($request->input('userId'));

        $fileName = $_FILES["file"]["name"];
        $fileTempName = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileError = $_FILES["file"]["error"];

        if ($fileSize < 1000000) {
            $newFileName = $user->username . "_" . rand(0, 10000) . "." . explode(".", $fileName)[1];
            $fileDestinationPath = $_SERVER['DOCUMENT_ROOT'] . "/images/profile/" . $newFileName;
            move_uploaded_file($fileTempName, $fileDestinationPath);
            $user->profileImg = $newFileName;
            $user->update();
            return response()->json($newFileName);
        }
    }
    
}
