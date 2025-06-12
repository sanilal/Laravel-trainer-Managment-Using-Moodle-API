<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalDocument;
use App\Models\TrainerProfile;
use App\Services\MoodleApiService;
use App\Models\Specialization; 
use Illuminate\Support\Facades\Storage;


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

        $existingDocuments = PersonalDocument::where('profile_id', $profile)
                            ->where('user_id', $trainerProfile->user_id)
                            ->latest()
                            ->first(); 

        return view('trainers.documents.create', [
            'profileId' => $trainerProfile->id,
            'userId' => $trainerProfile->user_id,
            'moodleUser' => $this->moodleApiService->getUserById($trainerProfile->user_id) ?? [],
            'existingDocuments' => $existingDocuments
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

         $existing = PersonalDocument::where('profile_id', $request->profile_id)
        ->where('user_id', $request->user_id)
        ->latest()
        ->first()
        ?? new PersonalDocument([
            'profile_id' => $request->profile_id,
            'user_id' => $request->user_id,
        ]);

    foreach (['your_id','your_passport','other_document','other_document2'] as $field) {
        if ($request->hasFile($field)) {
            if ($existing->$field) {
                Storage::disk('public')->delete($existing->$field);
            }
            $existing->$field = $request->file($field)->store('documents', 'public');
        }
    }

    $existing->save();

    return redirect()->route('trainers.specializations.create', [
        'profile' => $request->profile_id,
        'user'    => $request->user_id,
    ])->with('success','Documents saved');

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

public function destroy(Request $request, $profile, $field)
{
    \Log::info('Destroy called', compact('profile','field'));



    $document = PersonalDocument::where('profile_id', $profile)
            ->whereNotNull($field)
            ->first();

       \Log::info('Target document fetched', ['doc' => $document?->toArray()]);

       if (!$document) {
    return back()->with('error', 'No document found to delete.');
}
\Log::info('Deleting file path', ['path' => $document->$field]);

$deleted = Storage::disk('public')->delete($document->$field);
\Log::info('File delete result', ['deleted' => $deleted]);

$document->$field = null;
$saved = $document->save();
\Log::info('DB update result', ['saved' => $saved]);

    // if ($document && in_array($field, ['your_id','your_passport','other_document','other_document2'])) {
    //     Storage::disk('public')->delete($document->$field);
    //     $document->$field = null;
    //     $document->save();
    // }

    return back()->with('success','Document removed');
}

}
