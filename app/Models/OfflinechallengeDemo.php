<?php

namespace App\Models;
use App\Models\User;


use Illuminate\Database\Eloquent\Model;

class OfflinechallengeDemo extends Model
{
    protected $table = 'offlinechallenge_demo';

    protected $fillable = [
        'title',
        'type',
        'duration',
        'reward',
        'description',
        'points',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'offlinechallenge_demo_user',
            'offlinechallenge_demo_id',
            'user_id'
        );
    }
}
