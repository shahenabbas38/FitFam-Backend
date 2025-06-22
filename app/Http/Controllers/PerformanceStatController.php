<?php

namespace App\Http\Controllers;

use App\Models\PerformanceStat;
use Illuminate\Http\Request;

class PerformanceStatController extends Controller
{
    public function index()
    {
        return PerformanceStat::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_activity_minutes' => 'required|integer|min:0',
            'achievements_earned' => 'required|integer|min:0',
        ]);

        $stat = PerformanceStat::create($data);
        return response()->json($stat, 201);
    }

    public function show($id)
    {
        return PerformanceStat::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $stat = PerformanceStat::findOrFail($id);

        $data = $request->validate([
            'total_activity_minutes' => 'sometimes|required|integer|min:0',
            'achievements_earned' => 'sometimes|required|integer|min:0',
        ]);

        $stat->update($data);
        return response()->json($stat);
    }

    public function destroy($id)
    {
        $stat = PerformanceStat::findOrFail($id);
        $stat->delete();

        return response()->json(['message' => 'Performance stat deleted successfully']);
    }
}
