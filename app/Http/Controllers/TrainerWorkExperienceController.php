<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkExperience;

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
            'end_date' => 'required|date|after:start_date',
            'upload_work_document' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:16000',
            'job_description' => 'required|string',
        ]);

        $workExperience = new WorkExperience();
        $workExperience->profile_id = $request->profile_id;
        $workExperience->user_id = $request->user_id;
        $workExperience->name_of_the_organization = $request->name_of_the_organization;
        $workExperience->designation = $request->designation;
        $workExperience->start_date = $request->start_date;
        $workExperience->end_date = $request->end_date;
        $workExperience->job_description = $request->job_description;

        if ($request->hasFile('upload_work_document')) {
            $file = $request->file('upload_work_document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/work_documents'), $filename);
            $workExperience->upload_work_document = $filename;
        }

        $workExperience->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $experience = WorkExperience::find($id);
        if ($experience) {
            $experience->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Not found'], 404);
    }
}
