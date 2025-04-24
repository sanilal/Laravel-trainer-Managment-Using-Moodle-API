<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'user_id',
        'specialization',
        'name_of_the_institution',
        'start_date',
        'end_date',
        'upload_certificate',
    ];

    /**
     * Belongs to a trainer profile via profile_id.
     */
    public function trainerProfile()
    {
        return $this->belongsTo(TrainerProfile::class, 'profile_id');
    }

    /**
     * Optional: Belongs to a trainer using user_id (alternate relation).
     */
    public function user()
    {
        return $this->belongsTo(TrainerProfile::class, 'user_id', 'user_id');
    }
}
