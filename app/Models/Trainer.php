<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $connection = 'mysql'; // Laravel DB
    protected $table = 'trainers'; // Custom trainer table in Laravel
    protected $fillable = [
        'moodle_user_id', 'specialization', 'dob', 'email', 'photo', 'summary'
    ];
}
