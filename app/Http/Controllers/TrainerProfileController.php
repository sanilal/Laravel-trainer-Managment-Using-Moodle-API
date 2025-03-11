<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use App\Models\User;

class TrainerProfileController extends Controller
{
    public function create($moodleUserId)
    {
        $moodleUser = $this->getMoodleUser($moodleUserId); // Fetch user from Moodle API
        return view('trainers.create', compact('moodleUser'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'prefix' => 'nullable|string',
            'prefix2' => 'nullable|string',
            'gender' => 'nullable|string|in:male,female,other',
            'first_name' => 'nullable|string',
            'middle_name' => 'nullable|string',
            'family_name' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'country' => 'nullable|string',
            'residency_status' => 'nullable|string',
            'residing_city' => 'nullable|string',
            'email' => 'required|email|unique:trainer_profiles,email',
            'mobile_number' => 'nullable|string',
            'photo' => 'nullable|file|max:2048',
            'website' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'others' => 'nullable|string',
            'about_you' => 'nullable|string',
        ]);

        $profile = TrainerProfile::create($request->all());

        return redirect()->route('trainers.index')->with('success', 'Trainer Profile Created!');
    }

    private function getMoodleUser($moodleUserId)
    {
        // Fetch user from Moodle API
        return [
            "username" => "adminarkan",
            "firstname" => "John",
            "lastname" => "Doe",
            "email" => "design@iconceptme.com",
            "description" => "Experienced trainer",
            "country" => "AE",
            "profileimageurl" => "http://www.gravatar.com/avatar/12345",
        ];
    }
}
