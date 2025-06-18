<?php
// app/Models/UserChallenge.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class UserChallenge extends Model
{

    protected $fillable = [ 'user_id', 'challenge_id', 'join_date'];



    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
