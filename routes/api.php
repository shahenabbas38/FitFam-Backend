<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalProfileController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\UserChallengeController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PerformanceStatController;
use App\Http\Controllers\RewardSystemController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::get('user/{id}/profile', [UserController::class, 'getINFO_user']);
//Route::put('profile/{id},', [ProfileController::class, 'update']);
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
//Route::apiResource('challenges', ChallengeController::class);
Route::get('/challenges', [ChallengeController::class, 'index']);
Route::post('/challenges', [ChallengeController::class, 'store']);
Route::get('/challenges/{id}', [ChallengeController::class, 'show']);
//Route::put('/challenges/{id}', [ChallengeController::class, 'update']);
Route::put('/challenges/{id}/update', [ChallengeController::class, 'updateChallenge']);
Route::delete('/challenges/{id}', [ChallengeController::class, 'destroy']);
/***********************************************************************************/
Route::get('/user-challenges', [UserChallengeController::class, 'index']);         // عرض كل المشاركات
Route::post('/user-challenges', [UserChallengeController::class, 'store']);        // إنشاء مشاركة
Route::get('/user-challenges/{id}', [UserChallengeController::class, 'show']);       // عرض مشاركة واحدة
Route::put('/user-challenges/{id}', [UserChallengeController::class, 'update']);     // تحديث مشاركة
Route::delete('/user-challenges/{id}', [UserChallengeController::class, 'destroy']); // حذف مشاركة
/***********************************************************************************/


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/friend-requests/send/{receiverId}', [FriendRequestController::class, 'sendRequest']);
    Route::post('/friend-requests/accept/{id}', [FriendRequestController::class, 'acceptRequest']);
    Route::post('/friend-requests/reject/{id}', [FriendRequestController::class, 'rejectRequest']);

    Route::get('/friend-requests', [FriendRequestController::class, 'index']);
    Route::get('/friend-requests/sent', [FriendRequestController::class, 'sentRequests']);
    Route::get('/friend-requests/received', [FriendRequestController::class, 'receivedRequests']);

    Route::get('/friends', [FriendRequestController::class, 'friends']);
});
/***********************************************************************************/
Route::prefix('user-profiles')->group(function () {
    Route::get('/', [UserProfileController::class, 'index']);
    Route::post('/', [UserProfileController::class, 'store']);
    Route::get('{id}', [UserProfileController::class, 'show']);
    Route::put('{id}', [UserProfileController::class, 'update']);
    Route::delete('{id}', [UserProfileController::class, 'destroy']);
});
/***********************************************************************************/
Route::get('/performance-stats', [PerformanceStatController::class, 'index']);          
Route::post('/performance-stats', [PerformanceStatController::class, 'store']);         
Route::get('/performance-stats/{id}', [PerformanceStatController::class, 'show']);    
Route::put('/performance-stats/{id}', [PerformanceStatController::class, 'update']);
Route::delete('/performance-stats/{id}', [PerformanceStatController::class, 'destroy']);
/***********************************************************************************/
Route::get('/search-user', [UserController::class, 'searchUser']);
// ✅ مسارات نظام المكافآت
Route::prefix('rewards')->group(function () {
    Route::get('/', [RewardSystemController::class, 'index']);         // جلب كل المكافآت
    Route::post('/', [RewardSystemController::class, 'store']);        // إنشاء مكافأة جديدة
    Route::get('{id}', [RewardSystemController::class, 'show']);       // عرض مكافأة واحدة
    Route::put('{id}', [RewardSystemController::class, 'update']);     // تعديل المكافأة
    Route::delete('{id}', [RewardSystemController::class, 'destroy']); // حذف المكافأة
});
