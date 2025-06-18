<?php
// app/Models/Challenge.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [ 'name', 'start_date', 'end_date', 'created_by_id', 'is_public'];

    // علاقة: من أنشأ التحدي
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    // علاقة: المستخدمين المشاركين بالتحدي
    public function userChallenges()
    {
        return $this->hasMany(UserChallenge::class, 'challenge_id');
    }

    // علاقة مباشرة لجلب المستخدمين المشاركين بالتحدي
    public function participants()
    {
        return $this->hasManyThrough(User::class, UserChallenge::class, 'challenge_id', 'id', 'id', 'user_id');
    }
}
