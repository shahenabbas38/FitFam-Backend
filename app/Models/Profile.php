<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'family_members', 'age_group', 'preferred_activity', 'main_goal','weight'];
    protected $profile = 'profile';


    public function user()
    {
        return $this->belongTo(user::class);
    }
}
