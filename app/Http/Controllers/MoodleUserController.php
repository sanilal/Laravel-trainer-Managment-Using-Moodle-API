<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MoodleApiService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class MoodleUserController extends Controller
{
    protected $moodleApi;

    public function __construct(MoodleApiService $moodleApi)
    {
        $this->moodleApi = $moodleApi;
    }

    // Fetch users from Moodle with optional A-Z prefix filter
    public function fetchUsers(Request $request)
    {
        $prefix = $request->input('prefix', '%'); // default to all if no prefix provided

        // Use the new getUsersByEmailPrefix method
        if ($prefix === '%') {
            //$users = $this->moodleApi->getUsers(); // fallback to all users
            $users = $this->moodleApi->getUsers($request->prefix);
        } else {
            $users = $this->moodleApi->getUsersByEmailPrefix($prefix);
        }

        if (is_null($users) || !isset($users['users']) || !is_array($users['users'])) {
            $empty = collect([]);
            $paginatedUsers = new LengthAwarePaginator(
                $empty,
                0,
                10,
                LengthAwarePaginator::resolveCurrentPage(),
                ['path' => $request->url(), 'query' => $request->query()]
            );
            return view('moodle.users', ['users' => $paginatedUsers, 'selectedPrefix' => $prefix]);
        }

        // Get existing Laravel user data
        $existingEmails = \DB::table('trainer_profiles')->pluck('email')->toArray();
        $existingUserIds = \DB::table('trainer_profiles')->pluck('user_id')->toArray();

        // Filter users
        $filteredUsers = array_filter($users['users'], function ($user) use ($existingEmails, $existingUserIds) {
            return !in_array($user['email'], $existingEmails)
                && !in_array($user['id'], $existingUserIds)
                && $user['username'] !== 'guest'
                && !$user['suspended']
                && $user['confirmed'];
        });

        // Paginate users
        $userCollection = collect($filteredUsers);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentPageUsers = $userCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedUsers = new LengthAwarePaginator(
            $currentPageUsers,
            $userCollection->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('moodle.users', [
            'users' => $paginatedUsers,
            'selectedPrefix' => $prefix
        ]);
    }

    // Store Moodle user in Laravel DB
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
            'password' => Hash::make('defaultpassword')
        ]);

        return response()->json(['success' => true, 'message' => 'User added successfully.']);
    }
}
