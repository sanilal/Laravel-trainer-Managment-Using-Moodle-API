<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TrainerProfile;
use App\Models\Certification;

class SpecializationController extends Controller
{
    public function create($profile)
    {
        $trainerProfile = TrainerProfile::findOrFail($profile);
    
        // Fetch the specializations and certifications related to the trainer profile
        $specializations = Specialization::where('profile_id', $trainerProfile->id)->get();
        $certifications = Certification::where('profile_id', $trainerProfile->id)->get(); // Fetch certifications
    
        return view('trainers.specializations.create', [
            'profileId' => $trainerProfile->id,
            'userId' => $trainerProfile->user_id,
            'specializations' => $specializations,  // Pass specializations to the view
            'certifications' => $certifications,  // Pass certifications to the view
        ]);
    }
    

    // Store Specialization via AJAX
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'specialization' => 'required|string',
            'name_of_the_institution' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'upload_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Handle File Upload (if file is uploaded)
        $filePath = null;
        if ($request->hasFile('upload_certificate')) {
            $file = $request->file('upload_certificate');
            // Store file and get the path
            $filePath = $file->store('documents', 'public');
        }

        // Create Specialization record
        $specialization = Specialization::create([
            'profile_id' => $request->profile_id,
            'user_id' => $request->user_id,
            'specialization' => $request->specialization,
            'name_of_the_institution' => $request->name_of_the_institution,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'upload_certificate' => $filePath,
        ]);

        // Return success response with the created specialization details
        return response()->json([
            'success' => true,
            'message' => 'Specialization added successfully!',
            'specialization' => $specialization,
        ]);
    }


    public function complete(Request $request)
{
    // Validate the request
    $request->validate([
        'profile_id' => 'required|exists:trainer_profiles,id',
        'user_id' => 'required|exists:trainer_profiles,user_id',
    ]);

    // Check if the trainer has at least one specialization
    $specializationCount = Specialization::where('profile_id', $request->profile_id)->count();

    if ($specializationCount == 0) {
        return back()->with('error', 'Please add at least one specialization before proceeding.');
    }

    // Optional: Mark profile as specialization completed (if needed)
    TrainerProfile::where('id', $request->profile_id)->update(['specialization_completed' => true]);

    // Redirect to the next step (modify this URL as needed)
    return redirect()->route('next.step')->with('success', 'Specialization details completed successfully!');
}


    // Delete Specialization via AJAX
    public function destroy($id)
    {
        $specialization = Specialization::findOrFail($id);

        // Delete the file if it exists
        if ($specialization->upload_certificate && Storage::exists('public/' . $specialization->upload_certificate)) {
            Storage::delete('public/' . $specialization->upload_certificate);
        }

        // Delete the specialization record
        $specialization->delete();

        // Return success response
        return response()->json(['success' => true, 'message' => 'Specialization deleted successfully']);
    }
}
