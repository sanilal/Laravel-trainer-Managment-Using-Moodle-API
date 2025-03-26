<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'user_id',
        'name_of_the_organization',
        'designation',
        'start_date',
        'end_date',
        'upload_work_document',
        'job_description',
    ];

    // Relationship to Trainer Profile
    public function trainerProfile()
    {
        return $this->belongsTo(TrainerProfile::class, 'profile_id');
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
