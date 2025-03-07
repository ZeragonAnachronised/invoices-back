<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function registration(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|max:255|min:6'
        ]);

        $user = new User([
            'username' => $request->username,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $user->save();

        return response()->json([
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Неверные данные'
            ], 401);
        }

        return response()->json([
            'token' => $token
        ], 200);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
}
