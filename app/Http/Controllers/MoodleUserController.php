<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MoodleApiService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;



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
        $emailSearch = $request->input('email_search');
         $prefix = strtolower($request->input('prefix')); 
        
      if ($emailSearch) {
    $users = $this->moodleApi->getUsersByEmailPrefix($emailSearch);
} elseif ($prefix && $prefix !== 'all') {
    $users = $this->moodleApi->getUsersByEmailPrefix($prefix);
} else {
   try {
    $users = Cache::remember('moodle_all_users', 600, function () {
    return $this->moodleApi->getAllUsers();
});
} catch (\Exception $e) {
    Log::error('Moodle API error: ' . $e->getMessage());
    $users = ['users' => []]; // return empty
}
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
            return view('moodle.users', ['users' => $paginatedUsers]);
        }
    
        $existingEmails = \DB::table('trainer_profiles')->pluck('email')->toArray();
        $existingUserIds = \DB::table('trainer_profiles')->pluck('user_id')->toArray();
    
        $filteredUsers = array_filter($users['users'], function ($user) use ($existingEmails, $existingUserIds) {
            return !in_array($user['email'], $existingEmails) &&
                   !in_array($user['id'], $existingUserIds) &&
                   $user['username'] !== 'guest' &&
                   !$user['suspended'] &&
                   $user['confirmed'];
        });

      // $filteredUsers = $users['users']; 
    
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
    
        return view('moodle.users', ['users' => $paginatedUsers]);
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
