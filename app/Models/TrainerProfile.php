<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'user_name', 'prefix', 'prefix2', 'gender', 'first_name',
        'middle_name', 'family_name', 'date_of_birth', 'country', 'residency_status',
        'residing_city', 'email', 'mobile_number', 'profile_image', 'website',
        'facebook', 'instagram', 'youtube', 'twitter', 'linkedin', 'other_socialmedia', 'languages', 'about_you'
    ];

    /**
     * A trainer can have many specializations.
     */
    public function specializations()
    {
        return $this->hasMany(Specialization::class, 'profile_id');
    }

    /**
     * Optional: You can define this if you want to fetch only the first specialization
     */
    public function primarySpecialization()
    {
        return $this->hasOne(Specialization::class, 'profile_id')->latest();
    }
}
