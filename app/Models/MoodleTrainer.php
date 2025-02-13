<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodleTrainer extends Model
{
    protected $connection = 'moodle'; // Use Moodle DB
    protected $table = 'cocoon_user'; // Moodle users table
    protected $primaryKey = 'id'; // Moodle user ID
    public $timestamps = false;
}
