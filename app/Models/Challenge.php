<?php
// app/Models/Challenge.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Challenge extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'start_date', 'end_date', 'created_by_id', 'is_public'];

    protected static function booted() {
        static::creating(function ($challenge) {
            $challenge->id = (string) Str::uuid();
        });
    }

    public function userChallenges(): HasMany {
        return $this->hasMany(UserChallenge::class);
    }
}
