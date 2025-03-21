<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalDocument;
use App\Models\TrainerProfile;

class PersonalDocumentController extends Controller
{
    public function create($profileId)
    {
        return view('trainers.documents.create', compact('profileId'));
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

        return redirect()->route('trainers.dashboard')->with('success', 'Documents uploaded successfully.');
    }
}
