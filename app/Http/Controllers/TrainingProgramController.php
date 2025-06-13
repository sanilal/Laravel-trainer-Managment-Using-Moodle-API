<?php

// app/Http/Controllers/TrainingProgramController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingProgram;
use App\Models\TrainerProfile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class TrainingProgramController extends Controller
{
   
    public function index($profileId)
{
    $programs = TrainingProgram::where('profile_id', $profileId)->get();

    return response()->json($programs);
}
    public function create($profileId)
    {
      //  $profile = TrainerProfile::where('id', $profileId)->firstOrFail();
      $trainerProfile = TrainerProfile::findOrFail($profileId);
      $trainingProgrammes = TrainingProgram::where('profile_id', $trainerProfile->id)->get();
        return view('trainers.training_programs.create', [
            'profileId' => $trainerProfile->id,
            'userId' => $trainerProfile->user_id,
            'trainingProgrammes' => $trainingProgrammes
        ]);
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'profile_id' => 'required|exists:trainer_profiles,id',
            'user_id' => 'required|integer',
            'program_name' => 'required|string|max:255',
            'training_date' => 'nullable|date',
            'details' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors(),
        ], 422);
    }

    if ($request->hasFile('document')) {
        $path = $request->file('document')->store('training_documents', 'public');
        $validated['document'] = $path;
    }

    $trainingProgram = TrainingProgram::create($validated);

    return response()->json([
        'success' => true,
        'program' => $trainingProgram
    ]);
}


   public function destroy($id)
{
    $program = TrainingProgram::findOrFail($id);

    // Delete document if exists
    if ($program->document && Storage::disk('public')->exists($program->document)) {
        Storage::disk('public')->delete($program->document);
    }

    $program->delete();

    return response()->json(['success' => true]);
}
}
