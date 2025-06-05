<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalProfileController;
use App\Http\Controllers\ChallengeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('user/{id}/profile', [UserController::class, 'getprofile']);
// Route::put('profile/{id},', [ProfileController::class, 'update']);
Route::post('profile', [ProfileController::class, 'store']); //بعد البوست اسم المودل
Route::get('profile/{id}', [ProfileController::class, 'show']);
/************************************************************************************/
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
/********************************************************************************** */
Route::get('personal-profile/{user_id}', [PersonalProfileController::class, 'show']);
Route::post('personal-profile', [PersonalProfileController::class, 'store']);
Route::put('personal-profile/{user_id}', [PersonalProfileController::class, 'update']);
/************************************************************************************/
Route::apiResource('challenges', ChallengeController::class);
