<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    // Store Specialization via AJAX
    public function store(Request $request)
    {
        $request->validate([
            'specialization' => 'required|string',
            'name_of_the_institution' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'upload_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Handle File Upload
        $filePath = null;
        if ($request->hasFile('upload_certificate')) {
            $file = $request->file('upload_certificate');
            $filePath = $file->store('documents', 'public');
        }

        // Create Specialization
        $specialization = Specialization::create([
            'profile_id' => $request->profile_id,
            'user_id' => $request->user_id,
            'specialization' => $request->specialization,
            'name_of_the_institution' => $request->name_of_the_institution,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'upload_certificate' => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'specialization' => $specialization,
        ]);
    }

    // Delete Specialization via AJAX
    public function destroy($id)
    {
        $specialization = Specialization::findOrFail($id);
        $specialization->delete();

        return response()->json(['success' => true]);
    }
}
