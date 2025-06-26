<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RewardSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
        'badge',
        'virtual_reward',
        'steps',
        'completed_challenge',
        'invited_family',
        'active_day',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
