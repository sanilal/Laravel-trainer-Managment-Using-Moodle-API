<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainerProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
 
//  use App\Services\MoodleApiService;

class DashboardController extends Controller
{


    protected $moodle;

    // public function __construct(MoodleApiService $moodle)
    // {
    //     $this->moodle = $moodle;
    // }

    public function index(Request $request)
{
    $user = auth()->user(); 

    if ($user->is_admin) {
        $search = $request->query('q');

        $registeredEmails = TrainerProfile::pluck('email')->toArray();

        $activeTrainers = TrainerProfile::with([
            'personalDocuments',
            'specializations',
            'academics',
            'workExperiences',
            'trainingPrograms'
        ])->when($search, function ($q) use ($search) {
            $q->where('email', 'like', "%{$search}%")
              ->orWhere('first_name', 'like', "%{$search}%")
              ->orWhere('middle_name', 'like', "%{$search}%")
              ->orWhere('family_name', 'like', "%{$search}%")
              ->orWhere('prefix', 'like', "%{$search}%")
              ->orWhere('prefix2', 'like', "%{$search}%");
        })
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->withQueryString();

        return view('dashboard.admin', compact('activeTrainers', 'search'));

    } else {
                $trainer = $user->trainerProfile;

    if (!$trainer) {
    // go to /trainers/create (no model binding = no 404)
    return redirect()->route('trainer.create');
}

    // Example progress bar logic (you can customize this)
    $filled = collect([
        $trainer->first_name,
        $trainer->family_name,
        $trainer->email,
        $trainer->phone,
        $trainer->city,
        // add more fields as needed
    ])->filter()->count();

    $totalFields = 6; // adjust based on your profile structure
    $progress = ($filled / $totalFields) * 100;

    return view('dashboard.user', compact('trainer', 'progress'));
    }

    // 👤 For non-admins: redirect to personal profile edit (or load limited view)
}
}
