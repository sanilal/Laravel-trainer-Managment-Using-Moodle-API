<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\TrainerProfile;
use App\Models\PersonalDocument;
use App\Models\Specialization;
use App\Models\Academic;
use App\Models\User;
use App\Services\MoodleApiService;

class TrainerProfileController extends Controller
{
    use AuthorizesRequests;
  
      /** @var MoodleApiService */
    protected $moodleApi;

     // ───────────────────────────────
    // Constructor ‑ DI Moodle service
    // ───────────────────────────────
    public function __construct(MoodleApiService $moodleApi)
    {
        $this->moodleApi = $moodleApi;
    }

    // ───────────────────────────────
    // Simple list of all trainers
    // ───────────────────────────────
    public function index()
    {
        $trainers = TrainerProfile::all();
        return view('trainers.index', compact('trainers'));
    }
    // ───────────────────────────────
    // Create form
    //  → /trainers/create           (normal user)
    //  → /trainers/create/{id}      (admin pulls from Moodle ID)
    // ───────────────────────────────
    public function create(?int $moodleUserId = null)
{
    $authUser = auth()->user();

    // ⛔ Prevent access without Moodle ID
    if (!$moodleUserId) {
        abort(403, 'Trainer profile creation is only allowed via Moodle import.');
    }

    // ✅ Allow only admin to import
    if (!$authUser->is_admin) {
        abort(403, 'Only admins can import from Moodle.');
    }

    // Check local DB for cached profile
    $trainerProfile = TrainerProfile::where('user_id', $moodleUserId)->first();

    $profileImage = null;

    if (!$trainerProfile) {
        // Fetch from Moodle
        $moodleUser = $this->moodleApi->getUserById($moodleUserId);

        if (empty($moodleUser) || !isset($moodleUser['id'])) {
            Log::warning("No Moodle user found for ID {$moodleUserId}");
            return back()->withErrors(['msg' => 'No Moodle user found.']);
        }

        $profileImage = $moodleUser['profileimageurl'] ?? null;
    } else {
        // User already exists in our DB
        $moodleUser = [
            'id'        => $trainerProfile->user_id,
            'firstname' => $trainerProfile->first_name,
            'lastname'  => $trainerProfile->family_name,
            'email'     => $trainerProfile->email,
        ];
        $profileImage = $trainerProfile->profile_image;

        if (empty($trainerProfile->profile_image)) {
            $this->saveMoodleImage($trainerProfile, null);
        }
    }

    return view('trainers.create', [
        'moodleUser'   => $moodleUser,
        'profileImage' => $profileImage,
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

     $profile = new TrainerProfile();
        $this->saveProfileData($profile, $request);
    // $trainerProfile = new TrainerProfile();
    // // Set the trainer profile data from the request
    //  $this->saveProfileData($trainerProfile, $request);

     // deleted lines

     

   

    return redirect()->route('trainers.documents.create', ['profile' => $profile->id]);
    
}

 public function edit(int $id)
    {
        $profile = TrainerProfile::findOrFail($id);
         $this->authorize('update', $profile);
        return view('trainers.create', [
            'trainerProfile' => $profile,
            'moodleUser' => $profile,
            'profileId' => $profile->id,
             'userId' => $profile->user_id,
            'profileImage' => $profile->profile_image
        ]);
    }

public function update(Request $request, int $id)
{
    $trainerProfile = TrainerProfile::findOrFail($id);

    // Validate input
    $request->validate([
        'user_id' => 'required|numeric', // Validate but don't update
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

    // Save profile data except user_id
    // $this->saveProfileData($trainerProfile, $request->except('user_id'));

    $this->saveProfileData($trainerProfile, $request);


    // Check if personal documents already exist
    $hasDocs  = PersonalDocument::where('profile_id', $trainerProfile->id)->exists();

    // Redirect accordingly
    return redirect()
            ->route(
                $hasDocs ? 'trainers.documents.edit' : 'trainers.documents.create',
                ['profile' => $trainerProfile->id]
            )
            ->with('success', 'Trainer profile updated. Proceed to manage your documents.');
}


     //  Shared method to reduce code duplication
   protected function saveProfileData(TrainerProfile $trainerProfile, Request $request):void
{
    // Only set user_id if creating a new profile (i.e., if it's not already set)
    if (!$trainerProfile->exists || !$trainerProfile->user_id) {
        $trainerProfile->user_id = $request->input('user_id');
    }

     $trainerProfile->fill($request->except('profile_image'));

     if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image')
                            ->store('profile_images', 'public');
            $trainerProfile->profile_image = $file;
        }

    

    $trainerProfile->save();
}

    // Save Moodle avatar once
    protected function saveMoodleImage(TrainerProfile $profile, ?string $url): void
    {
        if (!$url) {
            return;
        }

        try {
            $img = file_get_contents($url);
            $name = 'profile_images/' . Str::random(40) . '.jpg';
            Storage::disk('public')->put($name, $img);
            $profile->update(['profile_image' => $name]);
            Log::info("Saved Moodle avatar for user_id {$profile->user_id}");
        } catch (\Throwable $e) {
            Log::error('Cannot cache Moodle image: ' . $e->getMessage());
        }
    }

    // ───────────────────────────────
    // Registered trainers list + filters
    // ───────────────────────────────
    public function registeredTrainers(Request $request)
{
    $query = TrainerProfile::query()->with(['specializations', 'academics']);
   
    $countries = config('countries.list');

    if ($request->filled('name')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('middle_name', 'like', '%' . $request->name . '%')
                ->orWhere('family_name', 'like', '%' . $request->name . '%');
        });
    }

    if ($request->filled('email')) {
       $query->where('email', 'like', "%{$request->email}%");
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    // if ($request->filled('country')) {
    //     $query->where('country', 'like', '%' . $request->country . '%');
    // }

    // if ($request->filled('city')) {
    //     $query->where('residing_city', 'like', '%' . $request->city . '%');
    // }

    // Filter by specialization title
     if ($request->filled('specialization')) {
            $query->whereHas('specializations', function ($q) use ($request) {
                $q->where('specialization', $request->specialization);
            });
        }

    // Filter by academic degree (or another valid column)
    if ($request->filled('academic')) {
            $query->whereHas('academics', function ($q) use ($request) {
                $q->where('academics', $request->academic);
            });
        }

    $trainers = $query->paginate(12);

    // Get all distinct specialization titles and academic degrees for filter options
     $specializations = Specialization::select('specialization')->distinct()->get();
    $academics       = Academic::select('academics')->distinct()->get();

     return view(
            'trainers.registered',
            compact('trainers', 'specializations', 'academics', 'countries')
        );
}

// ───────────────────────────────
    // Show single profile
    // ───────────────────────────────

 public function show($profileId)
    {
       $trainer = TrainerProfile::with([
            'specializations',
            'certifications',
            'academics',
            'workExperiences',
            'trainingPrograms',
            'personalDocuments',
        ])->findOrFail($profileId);

        return view('trainers.show', compact('trainer'));
    }

public function destroy(int $profileId)
{
    $profile = TrainerProfile::findOrFail($profileId);

    DB::transaction(function () use ($profile) {
        // Try to find matching user by email — optional
        $user = User::where('email', $profile->email)->first();

        if ($user) {
            $user->delete();
        }

        // Always delete the profile
        $profile->delete();
    });

    return redirect()
        ->route('dashboard')
        ->with('success', __('messages.trainer_deleted_successfully'));
}


}
