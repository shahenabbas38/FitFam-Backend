<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Services\PointCalculatorService;

class UserProfileController extends Controller
{
    public function index()
    {
        return UserProfile::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:user_profiles,user_id',
            'age' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'fitness_level' => 'nullable|string',
        ]);

        $data['points'] = PointCalculatorService::calculate($data);

        $profile = UserProfile::create($data);
        return response()->json($profile, 201);
    }

    public function show($id)
    {
        return UserProfile::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $profile = UserProfile::findOrFail($id);

        $data = $request->validate([
            'age' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'family_members' => 'nullable|integer',
            'preferred_activity' => 'nullable|string',
            'fitness_level' => 'nullable|string',
        ]);

        $data['points'] = PointCalculatorService::calculate($data);

        $profile->update($data);
        return response()->json($profile);
    }

    public function destroy($id)
    {
        $profile = UserProfile::findOrFail($id);
        $profile->delete();

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}
