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
    // First, check if the user exists in trainer_profiles table
    $trainerProfile = TrainerProfile::where('user_id', $id)->first();

    if ($trainerProfile) {
        // Use data from trainer_profiles
        $moodleUser = $trainerProfile; // You can rename this variable if needed
        \Log::info('Loaded trainer data from local trainer_profiles table.', ['trainerProfile' => $trainerProfile]);
    } else {
        // Fallback to Moodle API
        $userData = $moodleApi->getUserById($id);
        \Log::info('Moodle API Raw Response:', ['data' => $userData]);

        if (!empty($userData) && isset($userData['id'])) {
            $moodleUser = $userData;
            \Log::info('Extracted Moodle User from API:', ['moodleUser' => $moodleUser]);
        } else {
            $moodleUser = null;
            \Log::error('No Moodle user found or invalid response.');
        }
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
        'profile_image' => 'nullable|image|max:2048',
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
    $trainerProfile->gender = $request->input('gender'); // ✅ Add gender
    $trainerProfile->first_name = $request->input('first_name');
    $trainerProfile->middle_name = $request->input('middle_name');
    $trainerProfile->family_name = $request->input('family_name');
    $trainerProfile->date_of_birth = $request->input('date_of_birth');
    $trainerProfile->country = $request->input('country');
    $trainerProfile->residency_status = $request->input('residency_status');
    $trainerProfile->residing_city = $request->input('residing_city');
    $trainerProfile->email = $request->input('email');
    $trainerProfile->mobile_number = $request->input('mobile_number');

    // ✅ Handle profile image upload correctly
    if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('profile_images', 'public');
        $trainerProfile->profile_image = $path;
    }

    $trainerProfile->website = $request->input('website');
    $trainerProfile->twitter = $request->input('twitter');
    $trainerProfile->youtube = $request->input('youtube');
    $trainerProfile->instagram = $request->input('instagram');
    $trainerProfile->facebook = $request->input('facebook');
    $trainerProfile->linkedin = $request->input('linkedin');
    $trainerProfile->other_socialmedia = $request->input('other_socialmedia');
    $trainerProfile->about_you = $request->input('about_you');
    $trainerProfile->save();

    return redirect()->route('trainers.documents.create', ['profile' => $trainerProfile->id]);
}


    public function registeredTrainers(Request $request)
{
    $query = TrainerProfile::query()->with('specializations');

    if ($request->filled('name')) {
        $query->where(function($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->name . '%')
              ->orWhere('middle_name', 'like', '%' . $request->name . '%')
              ->orWhere('family_name', 'like', '%' . $request->name . '%');
        });
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('country')) {
        $query->where('country', 'like', '%' . $request->country . '%');
    }

    if ($request->filled('city')) {
        $query->where('residing_city', 'like', '%' . $request->city . '%');
    }

    $trainers = $query->paginate(12);

    return view('trainers.registered', compact('trainers'));
}

public function show($profileId)
{
    $trainer = TrainerProfile::with([
        'specializations', 
    ])->findOrFail($profileId);

    return view('trainers.show', compact('trainer'));
}
}
