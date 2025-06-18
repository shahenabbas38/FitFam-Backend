<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserChallengeRequest;
use Illuminate\Http\Request;
use App\Models\UserChallenge;

class UserChallengeController extends Controller
{
    public function index()
    {
        return UserChallenge::all();
    }

    public function store(UserChallengeRequest $request)
    {
        $data = $request->validated();  // تحقق من صحة البيانات

        $userChallenge = UserChallenge::create($data);  // إنشاء السجل

        return response()->json([
            'message' => 'User Challenge Created Successfully',
            'data' => $userChallenge
        ], 201);
    }

    /*****************************************************************************************/
    public function show($id)
    {
        return UserChallenge::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $userChallenge = UserChallenge::findOrFail($id);

        $data = $request->validate();

        $userChallenge->update($data);
        return response()->json($userChallenge);
    }

    public function destroy($id)
    {
        $userChallenge = UserChallenge::findOrFail($id);
        $userChallenge->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
