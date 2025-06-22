<?php

namespace App\Http\Controllers;

use App\Models\FamilyTreeFeature;
use Illuminate\Http\Request;

class FamilyTreeFeatureController extends Controller
{
    // عرض كل الإحصائيات مع اسم المستخدم
    public function index()
    {
        $features = FamilyTreeFeature::with('user:id,name')->get();

        $transformed = $features->map(function ($feature) {
            return [
                'user_id' => $feature->user_id,
                'user_name' => $feature->user->name ?? null,
                'challenges_completed' => $feature->challenges_completed,
            ];
        });

        return response()->json($transformed);
    }

    // إنشاء سجل جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:family_tree_features,user_id',
            'challenges_completed' => 'required|integer|min:0',
        ]);

        $feature = FamilyTreeFeature::create($data);

        return response()->json([
            'message' => 'Created successfully',
            'data' => [
                'user_id' => $feature->user_id,
                'challenges_completed' => $feature->challenges_completed,
            ]
        ], 201);
    }

    // عرض سجل واحد بناءً على user_id
    public function show($user_id)
    {
        $feature = FamilyTreeFeature::with('user:id,name')->where('user_id', $user_id)->firstOrFail();

        return response()->json([
            'user_id' => $feature->user_id,
            'user_name' => $feature->user->name ?? null,
            'challenges_completed' => $feature->challenges_completed,
        ]);
    }

    // تعديل سجل حسب user_id
    public function update(Request $request, $user_id)
    {
        $feature = FamilyTreeFeature::where('user_id', $user_id)->firstOrFail();

        $data = $request->validate([
            'challenges_completed' => 'required|integer|min:0',
        ]);

        $feature->update($data);

        return response()->json([
            'message' => 'Updated successfully',
            'data' => [
                'user_id' => $feature->user_id,
                'challenges_completed' => $feature->challenges_completed,
            ]
        ]);
    }

    // حذف سجل حسب user_id
    public function destroy($user_id)
    {
        $feature = FamilyTreeFeature::where('user_id', $user_id)->firstOrFail();
        $feature->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
