<?php

namespace App\Http\Controllers;

use App\Models\OfflineChallenge;

class OfflineChallengeController extends Controller
{
    public function getRandomChallenge()
    {
        $challenge = OfflineChallenge::inRandomOrder()->first();

        return response()->json($challenge);
    }
}
