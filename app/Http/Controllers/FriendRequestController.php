<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FriendRequestController extends Controller
{
    public function sendRequest($receiverId)
    {
        $senderId = Auth::id();

        if ($senderId == $receiverId) {
            return response()->json(['message' => 'You cannot add yourself.'], 400);
        }

        if (FriendRequest::where('sender_id', $senderId)->where('receiver_id', $receiverId)->exists()) {
            return response()->json(['message' => 'Request already sent.'], 409);
        }

        FriendRequest::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
        ]);

        return response()->json(['message' => 'Friend request sent.']);
    }

    public function acceptRequest($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->receiver_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->update(['status' => 'accepted']);

        return response()->json(['message' => 'Friend request accepted.']);
    }

    public function rejectRequest($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->receiver_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->update(['status' => 'rejected']);

        return response()->json(['message' => 'Friend request rejected.']);
    }

    public function index()
    {
        return FriendRequest::with(['sender', 'receiver'])->get();
    }
    //قائمة الأصدقاء المقبولين فقط
    public function friends()
    {
        $userId = Auth::id();

        $friends = FriendRequest::where('status', 'accepted')
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->with(['sender', 'receiver'])
            ->get()
            ->map(function ($request) use ($userId) {
                return $request->sender_id == $userId
                    ? $request->receiver
                    : $request->sender;
            });

        return response()->json($friends);
    }
    //الطلبات المرسلة (sent)
    public function sentRequests()
    {
        $userId = Auth::id();

        $sent = FriendRequest::with('receiver')
            ->where('sender_id', $userId)
            ->get();

        return response()->json($sent);
    }
    //الطلبات الواردة (received)
    public function receivedRequests()
    {
        $userId = Auth::id();

        $received = FriendRequest::with('sender')
            ->where('receiver_id', $userId)
            ->get();

        return response()->json($received);
    }
}
