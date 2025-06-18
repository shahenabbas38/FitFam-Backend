<?php
// app/Http/Controllers/ChallengeController.php

namespace App\Http\Controllers;

use App\Http\Requests\ChallengeRequest;
use App\Models\Challenge;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateChallengeRequest;

class ChallengeController extends Controller
{
    // إرجاع جميع التحديات
    public function index()
    {
        return Challenge::all();
    }

    // إنشاء تحدي جديد
    public function store(ChallengeRequest $request)
    {
        $challenge = Challenge::create($request->validated());
        return response()->json($challenge, 201);
    }


    // عرض تحدي واحد
    public function show($id)
    {
        return Challenge::findOrFail($id);
    }

    // تحديث تحدي
    public function updateChallenge(UpdateChallengeRequest $request, $id)
    {
        $challenge = Challenge::findOrFail($id);
        $challenge->update($request->validated());

        return response()->json($challenge);
    }


    // حذف تحدي
    public function destroy($id)
    {
        Challenge::destroy($id);
        return response()->json(null, 204);
    }
}
