<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\Storage;

class TrainerWorkExperienceController extends Controller
{
    public function create(Request $request)
    {
        $workExperiences = WorkExperience::where('profile_id', $request->profile)->get();
        return view('trainers.work_experience.create', compact('workExperiences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|exists:trainer_profiles,id',
            'user_id' => 'required|exists:users,id',
            'name_of_the_organization' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'upload_work_document' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:16000',
            'job_description' => 'required|string',
        ]);

        $filePath = null;
        if ($request->hasFile('upload_work_document')) {
            $filePath = $request->file('upload_work_document')->store('work_documents', 'public');
        }

        WorkExperience::create([
            'profile_id' => $request->profile_id,
            'user_id' => $request->user_id,
            'name_of_the_organization' => $request->name_of_the_organization,
            'designation' => $request->designation,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'job_description' => $request->job_description,
            'upload_work_document' => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Work experience saved successfully!'
        ]);
    }

    public function delete($id)
    {
        $experience = WorkExperience::find($id);
        if ($experience) {
            if ($experience->upload_work_document) {
                Storage::disk('public')->delete($experience->upload_work_document);
            }
            $experience->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Not found'], 404);
    }
}
