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
  
    try {
        // Validate input
        $request->validate([
            'moodle_user_id' => 'required|integer|exists:users,id|unique:trainer_profiles,user_id',
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

        // Insert into trainer_profiles table
        TrainerProfile::create([
            'user_id' => $request->moodle_user_id,
            'user_name' => $request->user_name,
            'prefix' => $request->prefix,
            'prefix2' => $request->prefix2,
            'gender' => $request->gender,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'family_name' => $request->family_name,
            'date_of_birth' => $request->dob,
            'country' => $request->country,
            'residency_status' => $request->residency_status,
            'residing_city' => $request->residing_city,
            'email' => $request->email,
            'mobile_number' => $request->phone,
            'photo' => $request->profileimage,
            'website' => $request->website,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'twitter' => $request->twitter,
            'other_socialmedia' => $request->other_socialmedia,
            'about_you' => $request->about_you,
        ]);

        return redirect()->route('trainers.index')->with('success', 'Trainer Profile Created!');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors('Error: ' . $e->getMessage());
    }
}

    

}
