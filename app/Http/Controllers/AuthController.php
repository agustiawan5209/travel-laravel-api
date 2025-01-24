<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Registrasi Penumpang
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'penumpang',
        ]);

        return response()->json([
            'message' => 'Penumpang berhasil didaftarkan!',
            'user' => $user,
        ], 201);
    }

    /**
     * login
     * Mengembalikan token untuk Admin dan Penumpang
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'message' => 'Login Gagal, Email atau Password Salah!'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('token-name')->plainTextToken;


        return response()->json([
            'message' => 'Login berhasil!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
    /**
     * logout
     * Logout Admin dan Penumpang
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil!'
        ]);
    }
}
