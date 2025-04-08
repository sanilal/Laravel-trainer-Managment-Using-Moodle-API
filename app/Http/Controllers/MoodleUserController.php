<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MoodleApiService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MoodleUserController extends Controller
{
    protected $moodleApi;

    public function __construct(MoodleApiService $moodleApi)
    {
        $this->moodleApi = $moodleApi;
    }

    // Fetch all users from Moodle excluding already added ones
    public function fetchUsers(Request $request)
    {
        $users = $this->moodleApi->getUsers(); // Fetch all users

   

        if (empty($users['users'])) {
            return view('moodle.users', ['users' => [], 'pagination' => null]);
        }

        // Get emails of users already added to Laravel
      //  $existingUsers = User::pluck('email')->toArray();

      $existingEmails = \DB::table('trainer_profiles')->pluck('email')->toArray();
        $existingUserIds = \DB::table('trainer_profiles')->pluck('user_id')->toArray();


        // Filter out users that are already in Laravel
        $filteredUsers = array_filter($users['users'], function ($user) use ($existingEmails, $existingUserIds) {
            return !in_array($user['email'], $existingEmails) &&
                   !in_array($user['id'], $existingUserIds) &&
                   $user['username'] !== 'guest' &&
                   !$user['suspended'] &&
                   $user['confirmed'];
        });

        // Convert to Laravel Collection for easier handling
        $userCollection = collect($filteredUsers);

        // Pagination setup
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10; // Change as needed
    $currentPageUsers = $userCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

    $paginatedUsers = new LengthAwarePaginator(
        $currentPageUsers,
        $userCollection->count(),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    $paginatedUsers->withPath($request->url())->onEachSide(1);

        return view('moodle.users', ['users' => $paginatedUsers]);
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
