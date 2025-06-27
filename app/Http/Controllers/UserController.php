<?php

namespace App\Http\Controllers;

// use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OfflineChallenge;





class UserController extends Controller
{
    public function register(Request $request)
    {
        // print_r($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'message' => 'User registered Successfully',
            'User' => $user
        ], 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if (!Auth::attempt($request->only('email', 'password'))) //اذا الايميل ةالباسورد غير متابقين
            return response()->json(
                [
                    'message' => 'invalid email or password'
                ],
                401
            );
        $user = User::where('email', $request->email)->FirstOrFail();
        $token = $user->createToken('auth_Token')->plainTextToken;
        return response()->json([
            'message' => 'login Successfully',
            'User' => $user,
            'Token' => $token
        ], 201);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'logout Successfully'
        ]);
    }
    public function searchUser(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->query('query');

        $users = User::where('name', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->get();

        return response()->json([
            'results' => $users
        ]);
    }
    public function joinChallenge(Request $request, $challengeId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $challenge = \App\Models\OfflineChallenge::findOrFail($challengeId);

        $user->offlineChallenges()->attach($challenge->id);

        return response()->json([
            'message' => 'Challenge joined successfully!',
            'challenge' => $challenge
        ]);
    }

    public function getTokenForUser($userId)
    {
        $user = User::findOrFail($userId);
        $token = $user->createToken('auth_Token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }
    public function getUserChallenges()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $challenges = $user->offlineChallenges()->get();

        return response()->json([
            'message' => 'User challenges fetched successfully.',
            'challenges' => $challenges
        ]);
    }
}
