<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;

Route::get('/', function () {
    return response()->json([
        "status" => 'true',
        "message" => "First Page"
    ]);
});

Route::post('register', [AuthController::class, 'register']);
