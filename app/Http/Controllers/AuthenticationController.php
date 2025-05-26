<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken($user->email);
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'token' => $token->plainTextToken,
            ]);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    function logout(Request $request)
    {
        $request->user()->tokens()->delete();

    return response()->json(['message' => 'Logged out successfully']);
    }   
    function register(Request $request)
    {
            $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create($validatedData);

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        } else {
            return response()->json(['message' => 'User registration failed'], 500);
        }

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }
    function resetPassword(Request $request)
    {
        // Logic for password reset
        return response()->json(['message' => 'Password reset successful']);
    }

    
}
