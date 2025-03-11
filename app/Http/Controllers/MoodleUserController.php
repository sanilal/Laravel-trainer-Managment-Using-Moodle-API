<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MoodleApiService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MoodleUserController extends Controller
{
    protected $moodleApi;

    public function __construct(MoodleApiService $moodleApi)
    {
        $this->moodleApi = $moodleApi;
    }

    // Fetch all users from Moodle excluding already added ones
    public function fetchUsers()
    {
        $users = $this->moodleApi->getUsers(); // Fetch all users

   

        if (empty($users['users'])) {
            return view('moodle.users', ['users' => []]);
        }

        // Get emails of users already added to Laravel
        $existingUsers = User::pluck('email')->toArray();

        // Filter out users that are already in Laravel
        $filteredUsers = array_filter($users['users'], function ($user) use ($existingUsers) {
            return !in_array($user['email'], $existingUsers) && 
                   $user['username'] !== 'guest' && 
                   !$user['suspended'] && 
                   $user['confirmed'];
        });

        return view('moodle.users', ['users' => $filteredUsers]);
    }

    // Store a Moodle user in Laravel database
    public function addUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'fullname' => 'required|string',
            'email' => 'required|email|unique:users,email'
        ]);

        User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make('defaultpassword') // Set a default password
        ]);

        return response()->json(['success' => true, 'message' => 'User added successfully.']);
    }
}
