<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
 use App\Services\MoodleApiService;

class DashboardController extends Controller
{


    protected $moodle;

    public function __construct(MoodleApiService $moodle)
    {
        $this->moodle = $moodle;
    }

    public function index()
    {
        // Get all Moodle users (using default A-Z range or 'a%' fallback)
        $moodleResponse = $this->moodle->getUsersByEmailPrefix(''); // fetch all, adjust logic if needed

        $moodleUsers = $moodleResponse['users'] ?? [];

        // Fetch all emails from trainer_profiles
        $registeredEmails = TrainerProfile::pluck('email')->toArray();

        // Filter LMS users who are not yet registered
        $notRegisteredLmsUsers = array_filter($moodleUsers, function ($user) use ($registeredEmails) {
            return !in_array($user['email'], $registeredEmails);
        });

        // Fetch active trainers with related tabs
        $activeTrainers = TrainerProfile::with([
            'personalDocuments',
            'specializations',
            'academics',
            'workExperiences',
            'trainingPrograms'
        ])->get();

        return view('dashboard', compact('notRegisteredLmsUsers', 'activeTrainers'));
       // return view('dashboard', compact('activeTrainers'));
    }
}
