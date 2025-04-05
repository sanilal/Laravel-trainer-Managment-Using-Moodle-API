<?php

// app/Http/Controllers/TrainingProgramController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingProgram;
use App\Models\TrainerProfile;

class TrainingProgramController extends Controller
{
    public function create($profileId)
    {
        $profile = TrainerProfile::where('id', $profileId)->firstOrFail();
        return view('trainers.training_programs.create', compact('profile'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'profile_id' => 'required|exists:trainer_profiles,id',
        'user_id' => 'required|integer',
        'program_name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'details' => 'nullable|string'
    ]);

    $trainingProgram = TrainingProgram::create($validated);

    return response()->json([
        'success' => true,
        'program' => $trainingProgram
    ]);
}


    public function destroy($id)
    {
        $program = TrainingProgram::findOrFail($id);
        $program->delete();

        return response()->json(['success' => true]);
    }
}
