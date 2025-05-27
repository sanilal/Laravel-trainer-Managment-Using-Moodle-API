<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use App\Services\MoodleApiService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        if (empty($trainerProfile->profile_image)) {
            $userData = $moodleApi->getUserById($id);
            if (!empty($userData['profileimageurl'])) {
                try {
                    $imageContents = file_get_contents($userData['profileimageurl']);
                    $imageName = 'profile_images/' . Str::random(40) . '.jpg';

                    Storage::disk('public')->put($imageName, $imageContents);

                    $trainerProfile->profile_image = $imageName;
                    $trainerProfile->save();

                    \Log::info('Moodle image saved locally for user_id ' . $id);
                } catch (\Exception $e) {
                    \Log::error('Failed to fetch Moodle image: ' . $e->getMessage());
                }
            }
        }
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

   // return view('trainers.create', compact('moodleUser'));
   return view('trainers.create', [
    'moodleUser' => $moodleUser,
    // 'profileImage' => isset($trainerProfile) && $trainerProfile ? $trainerProfile->profile_image : (isset($userData['profileimageurl']) ? $userData['profileimageurl'] : null),
    'profileImage' => isset($trainerProfile) ? $trainerProfile->profile_image : ($userData['profileimageurl'] ?? null),
]);

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
        'languages' => 'nullable|string',
        'about_you' => 'nullable|string',
    ]);

    $trainerProfile = new TrainerProfile();
    // Set the trainer profile data from the request
     $this->saveProfileData($trainerProfile, $request);

     // deleted lines
   

    return redirect()->route('trainers.documents.create', ['profile' => $trainerProfile->id]);
}

 public function edit($id)
    {
        $trainerProfile = TrainerProfile::findOrFail($id);
        return view('trainers.create', [
            'trainerProfile' => $trainerProfile,
            'moodleUser' => $trainerProfile,
            'profileImage' => $trainerProfile->profile_image
        ]);
    }

public function update(Request $request, $id)
    {
        $trainerProfile = TrainerProfile::findOrFail($id);

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
            'email' => 'required|email|unique:trainer_profiles,email,' . $trainerProfile->id,
            'mobile_number' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048',
            'website' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'youtube' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'other_socialmedia' => 'nullable|string',
            'languages' => 'nullable|string',
            'about_you' => 'nullable|string',
        ]);

        $this->saveProfileData($trainerProfile, $request);

        return redirect()->route('trainers.show', $trainerProfile->id)->with('success', 'Trainer profile updated successfully.');
    }

     // ✅ Shared method to reduce code duplication
    protected function saveProfileData(TrainerProfile $profile, Request $request)
    {
        $profile->user_id = $request->input('user_id');
        $profile->user_name = $request->input('user_name');
        $profile->prefix = $request->input('prefix');
        $profile->prefix2 = $request->input('prefix2');
        $profile->gender = $request->input('gender');
        $profile->first_name = $request->input('first_name');
        $profile->middle_name = $request->input('middle_name');
        $profile->family_name = $request->input('family_name');
        $profile->date_of_birth = $request->input('date_of_birth');
        $profile->country = $request->input('country');
        $profile->residency_status = $request->input('residency_status');
        $profile->residing_city = $request->input('residing_city');
        $profile->email = $request->input('email');
        $profile->mobile_number = $request->input('mobile_number');

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $profile->profile_image = $path;
        }

        $profile->website = $request->input('website');
        $profile->facebook = $request->input('facebook');
        $profile->instagram = $request->input('instagram');
        $profile->youtube = $request->input('youtube');
        $profile->twitter = $request->input('twitter');
        $profile->linkedin = $request->input('linkedin');
        $profile->other_socialmedia = $request->input('other_socialmedia');
        $profile->languages = $request->input('languages');
        $profile->about_you = $request->input('about_you');

        $profile->save();
    }


    public function registeredTrainers(Request $request)
    {
        $query = TrainerProfile::query()->with('specializations');

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
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
            'specializations', 'certifications', 'academics', 'workExperiences', 'trainingPrograms', 'personalDocuments'
        ])->findOrFail($profileId);

        return view('trainers.show', compact('trainer'));
    }
}
