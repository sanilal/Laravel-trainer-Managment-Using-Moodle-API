<?php
// app/Models/TrainingProgram.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'user_id',
        'program_name',
        'training_date',
        'document',
        'details',
    ];
}
