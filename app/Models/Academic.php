<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'user_id',
        'academics',
        'name_of_the_university',
        'start_date',
        'end_date',
        'upload_certificate',
    ];

    public function trainerProfile()
    {
        return $this->belongsTo(TrainerProfile::class, 'profile_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
