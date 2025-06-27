<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfflineChallenge extends Model
{
    protected $fillable = [
        'title',
        'description',
        'points',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
