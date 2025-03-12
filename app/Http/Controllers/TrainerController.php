<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        
        if ($request->has('email')) {
            $email = $request->input('email');
            $userData = $this->moodleApi->getUserByEmail($email);
            
            if (!empty($userData['users'])) {
                $moodleUser = $userData['users'][0];
    
                // Extract customfields
                $moodleUser['dob'] = null;
                if (!empty($moodleUser['customfields'])) {
                    foreach ($moodleUser['customfields'] as $field) {
                        if ($field['shortname'] === 'dob') {
                            $moodleUser['dob'] = date('Y-m-d', $field['value']); // Convert UNIX timestamp to date
                            break;
                        }
                    }
                }
            }
        }
    
        return view('trainers.create', compact('moodleUser'));
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
            'email' => 'required|email|unique:trainers,email',
            'username' => 'nullable|string',
            'specialization' => 'nullable|string',
            'dob' => 'nullable|date',
            'photo' => 'nullable|string',
            'summary' => 'nullable|string',
        ]);

        Trainer::create($request->all());

        return redirect()->route('trainer.register')->with('success', 'Trainer registered successfully.');
    }
}
