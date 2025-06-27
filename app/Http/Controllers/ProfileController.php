<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileController;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {
        $profile = Profile::where('user_id', $id)->firstOrFail();
        return response()->json($profile, 200);
    }

    public function store(StoreProfileController $request)
    {
        $profile = Profile::create($request->validated());
        return response()->json([
            'message' => 'Profile created successfully',
            'profile' => $profile
        ], 201);
    }

    public function showByUser($user_id)
    {
        $profile = Profile::where('user_id', $user_id)->first();

        if (!$profile) {
            return response()->json([
                'message' => 'Profile not found for this user.'
            ], 404);
        }

        return response()->json($profile, 200);
    }

    public function updateByUser(UpdateProfileRequest $request, $user_id)
    {
        $profile = Profile::where('user_id', $user_id)->firstOrFail();

        $profile->update($request->validated());

        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => $profile
        ], 200);
    }
}
