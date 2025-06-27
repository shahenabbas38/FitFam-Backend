<?php

namespace App\Http\Controllers;

use App\Models\FamilyTreeFeature;
use Illuminate\Http\Request;

class FamilyTreeFeatureController extends Controller
{
    public function index()
    {
        $features = FamilyTreeFeature::with('user')->get();

        $features = $features->map(function ($feature) {
            return [
                'id' => $feature->id,
                'user_id' => $feature->user_id,
                'user_name' => $feature->user ? $feature->user->name : null,
                'challenges_completed' => $feature->challenges_completed,
                'created_at' => $feature->created_at,
                'updated_at' => $feature->updated_at,
            ];
        });

        return response()->json($features);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'challenges_completed' => 'nullable|integer',
        ]);

        $feature = FamilyTreeFeature::create($data);

        return response()->json($feature, 201);
    }

    public function show($id)
    {
        $feature = FamilyTreeFeature::with('user')->findOrFail($id);

        $data = [
            'id' => $feature->id,
            'user_id' => $feature->user_id,
            'user_name' => $feature->user ? $feature->user->name : null,
            'challenges_completed' => $feature->challenges_completed,
            'created_at' => $feature->created_at,
            'updated_at' => $feature->updated_at,
        ];

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $feature = FamilyTreeFeature::findOrFail($id);

        $data = $request->validate([
            'challenges_completed' => 'nullable|integer',
        ]);

        $feature->update($data);

        return response()->json($feature);
    }

    public function destroy($id)
    {
        $feature = FamilyTreeFeature::findOrFail($id);
        $feature->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
