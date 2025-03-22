<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\PersonalDocument;
use App\Models\TrainerProfile;

class PersonalDocumentController extends Controller
{
public function create($profile)
{
    $trainerProfile = TrainerProfile::findOrFail($profile);

    return view('trainers.documents.create', [
        'profileId' => $trainerProfile->id, // Ensure this is being set
        'userId' => $trainerProfile->user_id,
        'moodleUser' => $this->fetchMoodleUser($trainerProfile->user_id) ?? []
    ]);
}



    

    public function store(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|exists:trainer_profiles,id',
            'user_id' => 'required|exists:users,id',
            'your_id' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
            'your_passport' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
            'other_document' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
            'other_document2' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
        ]);

        $document = new PersonalDocument();
        $document->profile_id = $request->profile_id;
        $document->user_id = $request->user_id;

        // Handle file uploads
        if ($request->hasFile('your_id')) {
            $document->your_id = $request->file('your_id')->store('documents', 'public');
        }
        if ($request->hasFile('your_passport')) {
            $document->your_passport = $request->file('your_passport')->store('documents', 'public');
        }
        if ($request->hasFile('other_document')) {
            $document->other_document = $request->file('other_document')->store('documents', 'public');
        }
        if ($request->hasFile('other_document2')) {
            $document->other_document2 = $request->file('other_document2')->store('documents', 'public');
        }

        $document->save();

       // return redirect()->route('trainers.dashboard')->with('success', 'Documents uploaded successfully.');
       return redirect()->route('trainers.documents.create', ['profile' => $request->input('profile_id')]);

       



    }


    private function fetchMoodleUser($userId)
{
    $moodleApiUrl = env('MOODLE_API_URL') . '/webservice/rest/server.php';
    $moodleApiToken = env('MOODLE_API_TOKEN');

    $params = [
        'wstoken' => $moodleApiToken,
        'wsfunction' => 'core_user_get_users',
        'moodlewsrestformat' => 'json',
        'criteria[0][key]' => 'id',
        'criteria[0][value]' => $userId
    ];

    $response = Http::get($moodleApiUrl, $params);

    if ($response->failed()) {
        return null; // Return null if API call fails
    }

    $data = $response->json();
    return $data['users'][0] ?? null;
}


}
