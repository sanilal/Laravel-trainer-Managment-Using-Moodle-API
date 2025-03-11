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
            'user_id' => 'required|exists:users,id',
            'prefix' => 'nullable|string',
            'prefix2' => 'nullable|string',
            'gender' => 'nullable|string|in:male,female,other',
            'first_name' => 'nullable|string',
            'middle_name' => 'nullable|string',
            'family_name' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'country' => 'nullable|string',
            'residency_status' => 'nullable|string',
            'residing_city' => 'nullable|string',
            'email' => 'required|email|unique:trainer_profiles,email',
            'mobile_number' => 'nullable|string',
            'photo' => 'nullable|file|max:2048',
            'website' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'others' => 'nullable|string',
            'about_you' => 'nullable|string',
        ]);

        TrainerProfile::create($request->all());

        return redirect()->route('trainers.index')->with('success', 'Trainer Profile Created!');
    }
}
