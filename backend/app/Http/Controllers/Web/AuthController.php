<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Web\Register;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Register $request)
    {

        try {

            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'guardian_name' => $request->guardian_name,
                'guardian_phone' => $request->guardian_phone,
                'institute_name' => $request->institute_name
            ]);

            return response()->json([
                "status" => "success",
                "message" => "User Registered Successfully",
            ], 200);
        } catch (QueryException $e) {

            Log::error('Registration Database Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Database error occurred. Please try again later.',
            ], 500);
        }
    }
}
