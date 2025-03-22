<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use App\Services\MoodleApiService;
use Illuminate\Support\Facades\Log;


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
        'user_id' => 'required|numeric', 
        'user_name' => 'required|string',
        'prefix' => 'nullable|string',
        'prefix2' => 'nullable|string',
        'gender' => 'nullable|string',
        'first_name' => 'nullable|string',
        'middle_name' => 'nullable|string',
        'family_name' => 'nullable|string',
        'date_of_birth' => 'nullable|date',
        'country' => 'nullable|string',
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

  // Now, create the trainer profile
  $trainerProfile = new TrainerProfile();
  $trainerProfile->user_id = $request->input('user_id');  // Ensure user_id is passed
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

  // return redirect()->route('trainer.profile.show', $trainerProfile->id);  // Redirect to the profile page or other action
  // return redirect()->route('trainers.documents.create', $trainerProfile->id);
  return redirect()->route('trainers.documents.create', ['profile_id' => $trainerProfile->id, 'user_id' => $trainerProfile->user_id]);



   
}

}
