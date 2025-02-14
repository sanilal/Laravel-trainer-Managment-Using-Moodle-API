<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainer;
use App\Services\MoodleApiService;

class TrainerController extends Controller
{
    protected $moodleApi;

    public function __construct(MoodleApiService $moodleApi)
    {
        $this->moodleApi = $moodleApi;
    }

    // Show the trainer registration form
    public function create()
    {
        return view('trainers.create');
    }

    // Fetch trainer details from Moodle using email
    public function fetchTrainerFromMoodle(Request $request)
    {
        $email = $request->input('email');
        $userData = $this->moodleApi->getUserByEmail($email);

        if (!empty($userData['users'])) {
            return response()->json($userData['users'][0]);
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    // Store trainer details in Laravel database
    public function store(Request $request)
    {
        $request->validate([
            'moodle_user_id' => 'required|integer|unique:trainers,moodle_user_id',
            'email' => 'required|email|unique:trainers,email',
            'specialization' => 'nullable|string',
            'dob' => 'nullable|date',
            'photo' => 'nullable|string',
            'summary' => 'nullable|string',
        ]);

        Trainer::create($request->all());

        return redirect()->route('trainer.register')->with('success', 'Trainer registered successfully.');
    }
}
