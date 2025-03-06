<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients',
            'password' => 'required|min:6',
            'phone' => 'required|numeric',
        ]);

        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        $token = $patient->createToken('authToken')->plainTextToken;

        return response()->json(['patient' => $patient, 'token' => $token], 201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $patient = Patient::where('email', $request->email)->first();

        if (!$patient || !Hash::check($request->password, $patient->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $patient->createToken('authToken')->plainTextToken;

        return response()->json(['patient' => $patient, 'token' => $token], 200);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}