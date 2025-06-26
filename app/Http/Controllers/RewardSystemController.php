<?php

namespace App\Http\Controllers;

use App\Models\RewardSystem;
use Illuminate\Http\Request;
use App\Services\PointCalculatorService;

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

        $data['points'] = PointCalculatorService::calculate($data);
        $data['badge'] = PointCalculatorService::assignBadge($data['points']);
        $data['virtual_reward'] = PointCalculatorService::assignVirtualReward($data['points']);

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

        $data['points'] = PointCalculatorService::calculate($merged);
        $data['badge'] = PointCalculatorService::assignBadge($data['points']);
        $data['virtual_reward'] = PointCalculatorService::assignVirtualReward($data['points']);

        $reward->update($data);
        return response()->json($reward);
    }

    public function destroy($id)
    {
        $reward = RewardSystem::findOrFail($id);
        $reward->delete();

        return response()->json(['message' => 'Reward deleted successfully']);
    }
}
