<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Web\Register;
use App\Models\User;
use App\Http\Requests\Web\Login;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Register $request)
    {

        try {
            User::create($request->validated());

            return response()->json([
                "status" => "success",
                "message" => "User Registered Successfully",
            ], 201);
        } catch (\Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Database error occurred.',
            ], 500);
        }
    }

    public function login(Login $request)
    {
        // 1. Check Credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        // 2. Role Check: Does the user's database role match the form they used?
        if ($user->role !== $request->role) {
            // Log them out immediately if the role doesn't match the portal
            Auth::guard('web')->logout();

            return response()->json([
                'status'  => 'error',
                'message' => "You do not have permission to access the {$request->role} portal."
            ], 403);
        }

        // 3. Issue Token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user'   => $user,
            'token'  => $token
        ]);
    }
}
