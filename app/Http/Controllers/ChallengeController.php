<?php
// app/Http/Controllers/ChallengeController.php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    // إرجاع جميع التحديات
    public function index() {
        return Challenge::all();
    }

    // إنشاء تحدي جديد
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'created_by_id' => 'required|uuid',
            'is_public' => 'required|boolean',
        ]);

        $challenge = Challenge::create($validated);
        return response()->json($challenge, 201);
    }

    // عرض تحدي واحد
    public function show($id) {
        return Challenge::findOrFail($id);
    }

    // تحديث تحدي
    public function update(Request $request, $id) {
        $challenge = Challenge::findOrFail($id);
        $challenge->update($request->all());
        return response()->json($challenge);
    }

    // حذف تحدي
    public function destroy($id) {
        Challenge::destroy($id);
        return response()->json(null, 204);
    }
}
 