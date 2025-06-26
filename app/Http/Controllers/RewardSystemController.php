<?php

namespace App\Http\Controllers;

use App\Models\RewardSystem;
use Illuminate\Http\Request;

class RewardSystemController extends Controller
{
    public function index()
    {
        return RewardSystem::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:reward_systems,user_id',
            'steps' => 'required|integer|min:0',
            'completed_challenge' => 'required|boolean',
            'invited_family' => 'required|boolean',
            'active_day' => 'required|boolean',
        ]);

        $data['points'] = $this->calculatePoints($data);
        $data['badge'] = $this->assignBadge($data['points']);
        $data['virtual_reward'] = $this->assignVirtualReward($data['points']);

        $reward = RewardSystem::create($data);
        return response()->json($reward, 201);
    }

    public function show($id)
    {
        return RewardSystem::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $reward = RewardSystem::findOrFail($id);

        $data = $request->validate([
            'steps' => 'sometimes|required|integer|min:0',
            'completed_challenge' => 'sometimes|required|boolean',
            'invited_family' => 'sometimes|required|boolean',
            'active_day' => 'sometimes|required|boolean',
        ]);

        $merged = array_merge($reward->toArray(), $data);

        $data['points'] = $this->calculatePoints($merged);
        $data['badge'] = $this->assignBadge($data['points']);
        $data['virtual_reward'] = $this->assignVirtualReward($data['points']);

        $reward->update($data);
        return response()->json($reward);
    }

    public function destroy($id)
    {
        $reward = RewardSystem::findOrFail($id);
        $reward->delete();

        return response()->json(['message' => 'Reward deleted successfully']);
    }

    // 🔢 حساب النقاط بناءً على النشاط
    private function calculatePoints(array $data): int
    {
        $points = 0;

        if (($data['steps'] ?? 0) >= 1000) {
            $points += 10;
        }

        if (!empty($data['completed_challenge'])) {
            $points += 50;
        }

        if (!empty($data['invited_family'])) {
            $points += 30;
        }

        if (!empty($data['active_day'])) {
            $points += 20;
        }

        return $points;
    }

    // 🏅 تحديد البادج
    private function assignBadge(int $points): string
    {
        if ($points >= 100) {
            return 'Gold 🥇';
        } elseif ($points >= 50) {
            return 'Silver 🥈';
        } else {
            return 'Bronze 🥉';
        }
    }

    // 🎁 تحديد المكافأة المالية
    private function assignVirtualReward(int $points): ?string
    {
        if ($points >= 1000) {
            return 'مبروك! ربحت 5$ 🎉';
        }

        return null;
    }
}
