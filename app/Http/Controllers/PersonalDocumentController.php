<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalDocument;
use App\Models\TrainerProfile;
use App\Services\MoodleApiService;
use App\Models\Specialization; // Assuming you have a Specialization model

class PersonalDocumentController extends Controller
{
  
    protected $moodleApiService;

    public function __construct(MoodleApiService $moodleApiService)
    {
        $this->moodleApiService = $moodleApiService;
    }

    public function create($profile)
    {
        $trainerProfile = TrainerProfile::findOrFail($profile);

        return view('trainers.documents.create', [
            'profileId' => $trainerProfile->id,
            'userId' => $trainerProfile->user_id,
            'moodleUser' => $this->moodleApiService->getUserById($trainerProfile->user_id) ?? []
        ]);
    }

    public function store(Request $request)
    {
        \Log::info('Incoming document upload request:', $request->all());

        $request->validate([
            'profile_id' => 'required|exists:trainer_profiles,id',
            'user_id' => 'required|exists:trainer_profiles,user_id', // Fix applied here
            'your_id' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
            'your_passport' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
            'other_document' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
            'other_document2' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
        ]);

        $document = new PersonalDocument();
        $document->profile_id = $request->profile_id;
        $document->user_id = $request->user_id;

        // Handle file uploads
        foreach (['your_id', 'your_passport', 'other_document', 'other_document2'] as $field) {
            if ($request->hasFile($field)) {
                $document->$field = $request->file($field)->store('documents', 'public');
            }
        }

        $document->save();

      //  return redirect()->route('trainers.documents.create', ['profile' => $request->input('profile_id')]);

          // Redirect to the specialization form, passing profile_id and user_id
          return redirect()->route('trainers.specializations.create', [
            'profile' => $request->input('profile_id'),
            'user' => $request->input('user_id')
        ]);

    }

    public function edit($profile)
{
    $trainerProfile = TrainerProfile::findOrFail($profile);
    $document = PersonalDocument::where('profile_id', $trainerProfile->id)->firstOrFail();

    return view('trainers.documents.edit', [
        'profileId' => $trainerProfile->id,
        'userId' => $trainerProfile->user_id,
        'document' => $document,
        'moodleUser' => $this->moodleApiService->getUserById($trainerProfile->user_id) ?? []
    ]);
}

public function update(Request $request, $profile)
{
    $request->validate([
        'your_id' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
        'your_passport' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
        'other_document' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
        'other_document2' => 'nullable|file|mimes:pdf,jpg,png|max:16000',
    ]);

    $document = PersonalDocument::where('profile_id', $profile)->firstOrFail();

    foreach (['your_id', 'your_passport', 'other_document', 'other_document2'] as $field) {
        if ($request->hasFile($field)) {
            $document->$field = $request->file($field)->store('documents', 'public');
        }
    }

    $document->save();
$specialization = Specialization::where('profile_id', $profile)
                                ->where('user_id', $document->user_id)
                                ->first();
   if ($specialization) {
    return redirect()->route('trainers.specializations.edit', $specialization->id)
                     ->with('success', 'Documents updated successfully.');
} else {
    return redirect()->route('trainers.specializations.create', [
        'profile' => $profile,
        'user' => $document->user_id
    ])->with('info', 'Please complete your specialization information.');
}
}

}
