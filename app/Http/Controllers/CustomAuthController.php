<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TrainerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomAuthController extends Controller
{

    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $profile = TrainerProfile::where('email', $email)->first();

        if (!$profile) {
            return back()->withErrors([
                'lms' => url('/moodle/users')
            ]);
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            // Ask to create password
            return view('auth.create_password', compact('email'));
        }

        // Show login with password
        return view('auth.login_password', compact('email'));
    }

    public function storePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->route('login.form')->withErrors([
                'email' => 'User already registered.'
            ]);
        }

        $profile = TrainerProfile::where('email', $request->email)->firstOrFail();

        $newUser = new User();
        $newUser->email = $request->email;
        $newUser->name = $profile->user_name ?? 'Unnamed'; // fallback just in case
        $newUser->password = Hash::make($request->password);
        $newUser->save();
\Log::info("New user registered: " . $newUser->email . " | Name: " . $newUser->name);

        Auth::login($newUser);

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $profile = TrainerProfile::where('email', $credentials['email'])->first();
        if (!$profile) {
            return redirect()->route('login.form')->withErrors([
                'lms' => 'User not found. Contact admin or check Moodle users list.'
            ]);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

           return redirect()
        ->route('login.password.form', ['email' => $credentials['email']])
        ->withErrors(['password' => 'Incorrect password. Please try again.']);

        // return back()->withErrors([
        //     'password' => 'Invalid password'
        // ]);
    }

    public function logout(Request $request)
{
    Auth::logout();

    // Invalidate session
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('status', 'You have been logged out.');
}

}
