<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academic;
use App\Models\TrainerProfile;
use Illuminate\Support\Facades\Storage;

class AcademicController extends Controller
{
    public function create($profile)
    {
        $trainerProfile = TrainerProfile::findOrFail($profile);
        $academics = Academic::where('profile_id', $trainerProfile->id)->get();

        return view('trainers.academics.create', [
            'profileId' => $trainerProfile->id,
            'userId' => $trainerProfile->user_id,
            'academics' => $academics,
        ]);
        
    }

    public function store(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'profile_id' => 'required|exists:trainer_profiles,id',
        'user_id' => 'required|exists:trainer_profiles,user_id',
        'academics' => 'required|in:diploma,bachelor degree,masters degree,doctoral degree',
        'name_of_the_university' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'upload_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($validator->fails()) {
        \Log::error('Validation Error:', $validator->errors()->toArray()); // Log errors
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    $filePath = null;
    if ($request->hasFile('upload_certificate')) {
        $filePath = $request->file('upload_certificate')->store('documents', 'public');
    }

    $academic = Academic::create([
        'profile_id' => $request->profile_id,
        'user_id' => $request->user_id,
        'academics' => $request->academics,
        'name_of_the_university' => $request->name_of_the_university,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'upload_certificate' => $filePath,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Academic record added successfully!',
        'academic' => $academic,
    ]);
}

    

    public function destroy($id)
    {
        $academic = Academic::findOrFail($id);

        if ($academic->upload_certificate && Storage::exists('public/' . $academic->upload_certificate)) {
            Storage::delete('public/' . $academic->upload_certificate);
        }

        $academic->delete();

        return response()->json(['success' => true, 'message' => 'Academic record deleted successfully']);
    }
}
