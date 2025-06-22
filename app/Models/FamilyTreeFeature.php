<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyTreeFeature extends Model
{
    protected $fillable = ['user_id', 'challenges_completed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
