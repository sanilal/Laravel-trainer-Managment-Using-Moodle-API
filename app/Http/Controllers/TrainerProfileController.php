<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use App\Services\MoodleApiService;
use Illuminate\Support\Facades\Log;

class TrainerProfileController extends Controller
{
    protected $moodleApi;

    // Inject MoodleApiService
    public function __construct(MoodleApiService $moodleApi)
    {
        $this->moodleApi = $moodleApi;
    }

    public function index()
    {
        $trainers = TrainerProfile::all();
        return view('trainers.index', compact('trainers'));
    }
    public function create($id, MoodleApiService $moodleApi)
    {
        $userData = $moodleApi->getUserById($id);
    
        \Log::info('Moodle API Raw Response:', ['data' => $userData]);
    
        if (!empty($userData) && isset($userData['id'])) {
            $moodleUser = $userData;  // Use the data directly
            \Log::info('Extracted Moodle User:', ['moodleUser' => $moodleUser]);
        } else {
            $moodleUser = null;
            \Log::error('No Moodle user found or invalid response.');
        }
        
        return view('trainers.create', compact('moodleUser'));
    }    

    


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric', 
            'user_name' => 'required|string',
            'prefix' => 'required|string',
            'prefix2' => 'required|string',
            'gender' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'family_name' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'country' => 'required|string',
            'residency_status' => 'nullable|string',
            'residing_city' => 'nullable|string',
            'email' => 'required|email|unique:trainer_profiles,email',
            'mobile_number' => 'nullable|string',
            'profile_image' => 'nullable|string',
            'website' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'youtube' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'other_socialmedia' => 'nullable|string',
            'about_you' => 'nullable|string',
        ]);

        $trainerProfile = new TrainerProfile();
        $trainerProfile->user_id = $request->input('user_id');
        $trainerProfile->user_name = $request->input('user_name');
        $trainerProfile->prefix = $request->input('prefix');
        $trainerProfile->prefix2 = $request->input('prefix2');
        $trainerProfile->first_name = $request->input('first_name');
        $trainerProfile->middle_name = $request->input('middle_name');
        $trainerProfile->family_name = $request->input('family_name');
        $trainerProfile->country = $request->input('country');
        $trainerProfile->residency_status = $request->input('residency_status');
        $trainerProfile->residing_city = $request->input('residing_city');
        $trainerProfile->email = $request->input('email');
        $trainerProfile->website = $request->input('website');
        $trainerProfile->linkedin = $request->input('linkedin');
        $trainerProfile->facebook = $request->input('facebook');
        $trainerProfile->instagram = $request->input('instagram');
        $trainerProfile->youtube = $request->input('youtube');
        $trainerProfile->twitter = $request->input('twitter');
        $trainerProfile->other_socialmedia = $request->input('other_socialmedia');
        $trainerProfile->about_you = $request->input('about_you');
        $trainerProfile->save();

        return redirect()->route('trainers.documents.create', ['profile' => $trainerProfile->id]);
    }

    
}
