<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserChallenge;

class UserChallengeController extends Controller
{
    public function index()
    {
        return UserChallenge::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'UserId' => 'required|string',
            'ChallengeId' => 'required|string',
            'JoinDate' => 'required|date',
        ]);

        $userChallenge = UserChallenge::create($data);
        return response()->json($userChallenge, 201);
    }

    public function show($id)
    {
        return UserChallenge::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $userChallenge = UserChallenge::findOrFail($id);

        $data = $request->validate([
            'UserId' => 'string',
            'ChallengeId' => 'string',
            'JoinDate' => 'date',
        ]);

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