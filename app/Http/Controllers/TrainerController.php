<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use App\Models\Trainer;
use App\Services\MoodleApiService;

class TrainerController extends Controller
{
    protected $moodleApi;

    public function __construct(MoodleApiService $moodleApi)
    {
        $this->moodleApi = $moodleApi;
    }

    // Show the trainer registration form
    public function create(Request $request)
{
    $moodleUser = null;
    $dob = null; // Initialize DOB as null

    if ($request->has('email')) {
        $email = $request->input('email');
        $userData = $this->moodleApi->getUserByEmail($email);

        if (!empty($userData['users'])) {
            $moodleUser = $userData['users'][0];

            // Debug log Moodle response
            \Log::info('Moodle User Data: ' . json_encode($moodleUser));

            if (!empty($moodleUser['customfields'])) {
                foreach ($moodleUser['customfields'] as $field) {
                    if ($field['shortname'] === 'dob') {
                        \Log::info('Raw DOB value from Moodle: ' . json_encode($field));

                        // Ensure it's numeric before conversion
                        if (isset($field['value']) && is_numeric($field['value'])) {
                            $dob = date('Y-m-d', (int) $field['value']); // Convert to YYYY-MM-DD format
                        } else {
                            \Log::error('DOB field is not a valid timestamp: ' . json_encode($field['value']));
                        }
                        break;
                    }
                }
            }
        }
    }

    // Debug log extracted DOB
    \Log::info('Extracted DOB: ' . json_encode($dob));

    return view('trainers.create', compact('moodleUser', 'dob'));
}
    

    public function fetchUsers()
{
    $users = $this->moodleApi->getUsers(); // Fetch all users

    if (empty($users['users'])) {
        return view('moodle.users', ['users' => []]);
    }

    // Get emails of users already added to Laravel
    $existingUsers = Trainer::pluck('email')->toArray();

    // Filter out users that are already in Laravel and match conditions
    $filteredUsers = array_filter($users['users'], function ($user) use ($existingUsers) {
        return !in_array($user['email'], $existingUsers) &&
               $user['username'] !== 'guest' &&
               !$user['suspended'] &&
               $user['confirmed'];
    });

    // Process each user and extract DOB
    foreach ($filteredUsers as &$user) {
        $user['dob'] = null; // Default value

        if (!empty($user['customfields'])) {
            foreach ($user['customfields'] as $field) {
                if ($field['shortname'] === 'dob') {
                    $user['dob'] = date('Y-m-d', $field['value']); // Convert UNIX timestamp to date
                    break;
                }
            }
        }
    }

    return view('moodle.users', ['users' => $filteredUsers]);
}


    // Fetch trainer details from Moodle using email
    public function fetchTrainerFromMoodle(Request $request)
    {
        $email = $request->input('email');
        $userData = $this->moodleApi->getUserByEmail($email);

        if (!empty($userData['users'])) {
            return response()->json($userData['users'][0]);
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    // Store trainer details in Laravel database
    public function store(Request $request)
    {
        $request->validate([
            'moodle_user_id' => 'required|integer|unique:trainers,moodle_user_id',
            'user_name' => 'required|string|unique:trainers,user_name',
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
            'email' => 'required|email|unique:trainers,email',
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

        TrainerProfile::create($request->all());

        return redirect()->route('trainer.register')->with('success', 'Trainer registered successfully.');
    }
}
