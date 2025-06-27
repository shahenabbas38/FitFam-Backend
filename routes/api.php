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
use App\Http\Controllers\OfflineChallengeController;
use App\Http\Controllers\FamilyTreeFeatureController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::get('user/{id}/profile', [UserController::class, 'getINFO_user']);
//Route::put('profile/{id},', [ProfileController::class, 'update']);
Route::post('profile', [ProfileController::class, 'store']); //بعد البوست اسم المودل
Route::get('profile/by-user/{user_id}', [ProfileController::class, 'showByUser']);
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
Route::middleware('auth:sanctum')->prefix('user-profiles')->name('user-profiles.')->group(function () {
    Route::get('/', [UserProfileController::class, 'index'])->name('index');          // GET /api/user-profiles
    Route::post('/', [UserProfileController::class, 'store'])->name('store');         // POST /api/user-profiles
    Route::get('{id}', [UserProfileController::class, 'show'])->name('show');         // GET /api/user-profiles/{id}
    Route::put('{id}', [UserProfileController::class, 'update'])->name('update');     // PUT /api/user-profiles/{id}
    Route::delete('{id}', [UserProfileController::class, 'destroy'])->name('destroy'); // DELETE /api/user-profiles/{id}
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
/***********************************************************************************/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('user-profiles/{id}/add-points', [UserProfileController::class, 'addPoints']);
});
/***********************************************************************************/
Route::middleware('auth:sanctum')->get('offline-challenge', [OfflineChallengeController::class, 'getRandomChallenge']);
Route::post('get-token/{id}', [UserController::class, 'getTokenForUser']);
Route::middleware('auth:sanctum')->get('user/challenges', [UserController::class, 'getUserChallenges']);
Route::middleware('auth:sanctum')->post('user/join-challenge/{id}', [UserController::class, 'joinChallenge']);
/***********************************************************************************/
Route::prefix('family-tree-features')->group(function () {
    Route::get('/index', [FamilyTreeFeatureController::class, 'index']);
    Route::post('/create', [FamilyTreeFeatureController::class, 'store']);
    Route::get('/show/{id}', [FamilyTreeFeatureController::class, 'show']);
    Route::put('/update/{id}', [FamilyTreeFeatureController::class, 'update']);
    Route::delete('/delete/{id}', [FamilyTreeFeatureController::class, 'destroy']);
});
