<?php

namespace App\Http\Controllers;

use App\Models\OfflinechallengeDemo;

class OfflineChallengeController extends Controller
{
    public function getRandomChallenge()
    {
        $challenge = OfflinechallengeDemo::inRandomOrder()->first();

        return response()->json($challenge);
    }
}
