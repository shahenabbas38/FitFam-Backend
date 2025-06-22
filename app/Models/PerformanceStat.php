<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerformanceStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_activity_minutes',
        'achievements_earned',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
