<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    // عرض جميع الملفات الشخصية
    public function index()
    {
        return UserProfile::all();
    }

    // إنشاء ملف شخصي جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:user_profiles,user_id',
            'age' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'fitness_level' => 'nullable|string',
        ]);

        // احسب النقاط تلقائيًا
        $data['points'] = $this->calculatePoints($data);

        $profile = UserProfile::create($data);
        return response()->json($profile, 201);
    }

    // عرض ملف واحد
    public function show($id)
    {
        return UserProfile::findOrFail($id);
    }

    // تعديل ملف شخصي
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

        // احسب النقاط بعد التعديل
        $data['points'] = $this->calculatePoints($data);

        $profile->update($data);
        return response()->json($profile);
    }

    // حذف ملف شخصي
    public function destroy($id)
    {
        $profile = UserProfile::findOrFail($id);
        $profile->delete();

        return response()->json(['message' => 'Profile deleted successfully']);
    }

    // 🔢 تابع لحساب النقاط (المعادلة تحددها لاحقًا)
    private function calculatePoints(array $data): int
    {
        return 0; // مؤقتًا صفر، سيتم تعديلها لاحقًا حسب تعليماتك
    }
}
