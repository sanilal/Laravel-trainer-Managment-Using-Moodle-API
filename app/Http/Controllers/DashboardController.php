<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use Illuminate\Support\Facades\DB;
//  use App\Services\MoodleApiService;

class DashboardController extends Controller
{


    protected $moodle;

    // public function __construct(MoodleApiService $moodle)
    // {
    //     $this->moodle = $moodle;
    // }

    public function index(Request $request)
    {

         $search = $request->query('q');  
        // Get all Moodle users (using default A-Z range or 'a%' fallback)
        // $moodleResponse = $this->moodle->getUsersByEmailPrefix(''); // fetch all, adjust logic if needed

        // $moodleUsers = $moodleResponse['users'] ?? [];

        // Fetch all emails from trainer_profiles
        $registeredEmails = TrainerProfile::pluck('email')->toArray();

        // Filter LMS users who are not yet registered
        // $notRegisteredLmsUsers = array_filter($moodleUsers, function ($user) use ($registeredEmails) {
        //     return !in_array($user['email'], $registeredEmails);
        // });

        // Fetch active trainers with related tabs
        $activeTrainers = TrainerProfile::with([
            'personalDocuments',
            'specializations',
            'academics',
            'workExperiences',
            'trainingPrograms'
        ])->when($search, function ($q) use ($search) {
            $q->where('email', 'like', "%{$search}%")
              ->orWhere('first_name', 'like', "%{$search}%")
              ->orWhere('middle_name', 'like', "%{$search}%")
              ->orWhere('family_name', 'like', "%{$search}%")
              ->orWhere('prefix', 'like', "%{$search}%")
              ->orWhere('prefix2', 'like', "%{$search}%");
        })
        ->orderBy('id', 'desc')
        ->paginate(10)            // << page size
        ->withQueryString();      // keeps ?q in links

    return view('dashboard', compact('activeTrainers', 'search'));
    }
}
