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

    /* ───────── Admin dashboard ───────── */
        if ($user->is_admin) {
            $search = $request->query('q');

            $activeTrainers = TrainerProfile::with([
                    'personalDocuments',
                    'specializations',
                    'academics',
                    'workExperiences',
                    'trainingPrograms',
                ])
                ->when($search, function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('email',        'like', "%{$search}%")
                          ->orWhere('first_name', 'like', "%{$search}%")
                          ->orWhere('middle_name','like', "%{$search}%")
                          ->orWhere('family_name','like', "%{$search}%")
                          ->orWhere('prefix',     'like', "%{$search}%")
                          ->orWhere('prefix2',    'like', "%{$search}%");
                    });
                })
                ->orderByDesc('id')
                ->paginate(10)
                ->withQueryString();

            return view('dashboard.admin', compact('activeTrainers', 'search'));
        }
 /* ───────── Trainer: go to own profile ───────── */
        $trainer = $user->trainerProfile;

        // If no profile yet → send to “Create profile” page
        if (!$trainer) {
            return redirect()->route('trainers.create');
        }

        // Profile exists → send to “Edit my profile”
        return redirect()->route('trainers.edit', $trainer->id);

}
}
