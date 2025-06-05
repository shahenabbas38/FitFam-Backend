<?php
namespace App\Http\Controllers;


use App\Http\Requests\StorePersonalProfileRequest;
use App\Models\PersonalProfile;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class PersonalProfileController extends Controller
{
    public function show($id)
    {
        $profile = PersonalProfile::where('user_id', $id)->firstOrFail();
        return response()->json($profile,200);
    }

    public function store(StorePersonalProfileRequest $request)
    {

        $profile = PersonalProfile::create($request->validated());
        return response()->json([
            'message' => 'Personal profile created successfully',
            'profile' => $profile,
        ], 201);
    }

    public function update(Request $request, $user_id)
    {
        $profile = PersonalProfile::where('user_id', $user_id)->firstOrFail();
        $profile->update($request->only(['age', 'weight', 'family_members', 'preferred_activity']));

        return response()->json([
            'message' => 'Personal profile updated successfully',
            'profile' => $profile,
        ]);
    }
}
