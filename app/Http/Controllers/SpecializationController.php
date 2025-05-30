<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TrainerProfile;
use App\Models\Certification;
use App\Models\Academic; // Assuming you have an Academic model

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
           'end_date' => 'required|date|after_or_equal:start_date',
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
  
       // Check if an academic record already exists for this profile
    $existingAcademic = Academic::where('profile_id', $request->profile_id)->first();

    if ($existingAcademic) {
        return redirect()
            // ->route('trainers.academics.edit', ['id' => $existingAcademic->id])
            ->route('trainers.academics.create', ['profile' => $request->profile_id])
            ->with('success', 'Specializations saved. Please update your academic information.');
    } else {
        return redirect()
            ->route('trainers.academics.create', ['profile' => $request->profile_id])
            ->with('success', 'Specializations saved. Please provide your academic information.');
    }
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

  public function edit($id)
{
    $specialization = Specialization::findOrFail($id);

    $profileId = $specialization->profile_id; // or however it's named in your model
    $userId = $specialization->user_id;       // assuming this is stored in the specialization

    // Fetch all specializations for this profile/user if needed
    $specializations = Specialization::where('profile_id', $profileId)->get();

    // If certifications are stored separately
    $certifications = Certification::where('profile_id', $profileId)->get(); // Update model name if different

    return view('trainers.specializations.edit', compact(
        'specialization',
        'profileId',
        'userId',
        'specializations',
        'certifications'
    ));
}


public function update(Request $request, $id)
{
    $request->validate([
        'specialization' => 'required|string|max:255',
        'name_of_the_institution' => 'nullable|string|max:255',
        'name_of_the_institution' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        'upload_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $specialization = Specialization::findOrFail($id);

    $specialization->update($request->except('upload_certificate'));

    if ($request->hasFile('upload_certificate')) {
    // Delete old file
    if ($specialization->upload_certificate && Storage::exists('public/' . $specialization->upload_certificate)) {
        Storage::delete('public/' . $specialization->upload_certificate);
    }

    // Upload new file
    $path = $request->file('upload_certificate')->store('certificates', 'public');
    $specialization->upload_certificate = $path;
    $specialization->save();
}

    return redirect()->route('trainers.academics.edit', ['profile' => $request->profile_id]);;

}



}
