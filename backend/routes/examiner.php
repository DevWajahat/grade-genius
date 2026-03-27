<?php

use App\Http\Controllers\Examiner\ExamHallController;
use Illuminate\Support\Facades\Route;

Route::prefix('exam-halls/')->controller(ExamHallController::class)->name('exam-hall.')->group(function () {

    Route::post('store', 'store')->name('store');
    Route::get('/', 'index')->name('index');
    Route::get('show/{id}', 'show')->name('show');
    Route::post('update/{id}', 'update')->name('update');
});
