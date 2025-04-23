<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    // Store Certification via AJAX
    public function store(Request $request)
    {
        $request->validate([
            'certified_in' => 'required|string',
            'cert_name_of_the_institution' => 'required|string',
            'cert_start_date' => 'required|date',
            'cert_end_date' => 'required|date',
            'cert_upload_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Handle File Upload
        $filePath = null;
        if ($request->hasFile('cert_upload_certificate')) {
            $file = $request->file('cert_upload_certificate');
            $filePath = $file->store('documents', 'public');
        }

        // Create Certification
        $certification = Certification::create([
            'profile_id' => $request->profile_id,
            'user_id' => $request->user_id,
            'certified_in' => $request->certified_in,
            'name_of_the_institution' => $request->cert_name_of_the_institution,
            'start_date' => $request->cert_start_date,
            'end_date' => $request->cert_end_date,
            'upload_certificate' => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'certification' => $certification,
        ]);
    }

    // Delete Certification via AJAX
    public function destroy($id)
    {
        $certification = Certification::findOrFail($id);
        $certification->delete();

        return response()->json(['success' => true]);
    }
}
