<?php
// app/Models/UserChallenge.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserChallenge extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'user_id', 'challenge_id', 'join_date'];

    protected static function booted() {
        static::creating(function ($userChallenge) {
            $userChallenge->id = (string) Str::uuid();
        });
    }

    public function challenge() {
        return $this->belongsTo(Challenge::class);
    }
}
