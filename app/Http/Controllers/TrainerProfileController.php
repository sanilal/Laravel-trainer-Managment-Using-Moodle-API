<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use App\Models\User;
use App\Services\MoodleApiService;

class TrainerProfileController extends Controller
{
    protected $moodleApi; // Correctly define the property at the class level



    // Inject MoodleApiService
    public function __construct(MoodleApiService $moodleApi)
    {
        $this->moodleApi = $moodleApi;
    }


    public function index()
{
    // Fetch trainers from database
    $trainers = TrainerProfile::all(); // Adjust based on your model
    
    // Return view with trainers
    return view('trainers.index', compact('trainers'));
}
    public function create($id, MoodleApiService $moodleApi)
    {
        $moodleUser = null;
    
        $userData = $moodleApi->getUserById($id);
    
        \Log::info('Moodle User Data:', ['data' => $userData]);
    
        if (!empty($userData) && isset($userData[0])) {
            $moodleUser = $userData[0];
        }
    
        return view('trainers.create', compact('moodleUser'));
    }
    
    public function store(Request $request)
{
    $request->validate([
        'moodle_user_id' => 'required|integer|unique:trainer_profiles,user_id',
        'user_name' => 'required|string|unique:trainer_profiles,user_name',
        'prefix' => 'nullable|string',
        'prefix2' => 'nullable|string',
        'gender' => 'nullable|string',
        'first_name' => 'nullable|string',
        'middle_name' => 'nullable|string',
        'family_name' => 'nullable|string',
        'dob' => 'nullable|date',
        'country' => 'nullable|string',
        'residency_status' => 'nullable|string',
        'residing_city' => 'nullable|string',
        'email' => 'required|email|unique:trainer_profiles,email',
        'phone' => 'nullable|string',
        'profileimage' => 'nullable|string',
        'website' => 'nullable|string',
        'linkedin' => 'nullable|string',
        'facebook' => 'nullable|string',
        'instagram' => 'nullable|string',
        'youtube' => 'nullable|string',
        'twitter' => 'nullable|string',
        'other_socialmedia' => 'nullable|string',
        'about_you' => 'nullable|string',
    ]);

       // Fetch the user from the Moodle API
    $moodleUser = $this->moodleApi->getUserById($request->moodle_user_id);

    if (empty($moodleUser)) {
        return back()->withErrors(['moodle_user_id' => 'Moodle user not found.']);
    }

    // Check if the user already has a profile (Optional: You can skip this step based on your logic)
    $existingProfile = TrainerProfile::where('user_id', $request->moodle_user_id)->first();
    if ($existingProfile) {
        return back()->withErrors(['moodle_user_id' => 'This user already has a profile.']);
    }

    // Map moodle_user_id to user_id
    $data = $request->all();
    $data['user_id'] = $request->moodle_user_id;

    TrainerProfile::create($data);

    return redirect()->route('trainers.index')->with('success', 'Trainer Profile Created!');
}

}
