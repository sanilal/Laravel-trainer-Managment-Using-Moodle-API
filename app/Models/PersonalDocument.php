<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'user_id',
        'your_id',
        'your_passport',
        'other_document',
        'other_document2',
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
