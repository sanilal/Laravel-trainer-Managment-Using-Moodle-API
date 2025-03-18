<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerProfile extends Model
{
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'trainer_profiles'; 

    protected $fillable = [
        'user_id', 'user_name', 'prefix', 'prefix2', 'gender', 'first_name', 
        'middle_name', 'family_name', 'date_of_birth', 'country', 'residency_status', 
        'residing_city', 'email', 'mobile_number', 'profile_image', 'website', 
        'facebook', 'instagram', 'youtube', 'twitter', 'other_socialmedia', 'about_you'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

