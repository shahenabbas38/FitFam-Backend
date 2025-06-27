<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'weight',
        'height',
        'family_members',
        'preferred_activity',
        'fitness_level',
        'points',
    ];
    protected $appends = ['badge'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /********************************************************************/
    public function getBadgeAttribute()
    {
        $points = $this->points;

        if ($points >= 100) {
            return '🥇 Gold';
        } elseif ($points >= 50) {
            return '🥈 Silver';
        } elseif ($points > 0) {
            return '🥉 Bronze';
        } else {
            return '❌ No badge';
        }
    }
}
