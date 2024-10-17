<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $doesUserAlreadyExist = User::where('email', $request->email)->first();

        if($doesUserAlreadyExist)
        {
            return response()->json([
                'error' => 'Email already registered'
            ], 400);
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $token = JTWAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $login = JWTAuth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (!$login)
        {
            return response()->json([
                'error' => 'Wrong credentials'
            ], 400);
        }

        $user = auth()->user();

        return response()->json([
            'token' => $login,
            'user' => $user
        ]);
    }
}
