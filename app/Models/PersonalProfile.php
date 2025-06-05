<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'weight',
        'family_members',
        'preferred_activity',
    ];
    protected $table = 'personal_profiles';



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
