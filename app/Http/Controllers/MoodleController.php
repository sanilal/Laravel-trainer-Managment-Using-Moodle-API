<?php

namespace App\Http\Controllers;

use App\Services\MoodleApiService;

class MoodleController extends Controller
{
    public function test(MoodleApiService $moodleApi)
    {
        $email = 'design@iconceptme.com';
        $user = $moodleApi->getUserByEmail($email);
        return response()->json($user);
    }
}
