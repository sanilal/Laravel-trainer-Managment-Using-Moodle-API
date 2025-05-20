<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodleController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MoodleUserController;
use App\Http\Controllers\TrainerProfileController;
use App\Http\Controllers\PersonalDocumentController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\TrainerWorkExperienceController;
use App\Http\Controllers\TrainingProgramController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;

// Public Routes (no auth middleware)
Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('changeLang');

Route::get('/login', [CustomAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/check', [CustomAuthController::class, 'verifyEmail'])->name('login.check');
Route::post('/login/create-password', [CustomAuthController::class, 'storePassword'])->name('login.create_password');
Route::post('/login/attempt', [CustomAuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout.get');

// Protected Routes (only for logged-in users)
Route::middleware('auth')->group(function () {
    // Moodle API Test Route
    Route::get('/moodle/test', [MoodleController::class, 'test']);

    // Moodle Users (for registration)
    Route::get('/moodle/users', [MoodleUserController::class, 'fetchUsers'])->name('moodle.users');
    Route::post('/moodle/users/add', [MoodleUserController::class, 'addUser'])->name('moodle.users.add');
    Route::get('/moodle-users', [MoodleUserController::class, 'fetchUsers'])->name('moodle.users.fetch');

    // Trainer Profile
    Route::get('/trainers', [TrainerProfileController::class, 'index'])->name('trainers.index');
    Route::get('/trainers/create/{moodleUserId}', [TrainerProfileController::class, 'create'])->name('trainer.create');
    Route::post('/trainer/store', [TrainerProfileController::class, 'store'])->name('trainer.store');
    Route::get('/trainers/{profile}/show', [TrainerProfileController::class, 'show'])->name('trainer.show');
    Route::get('trainers/registered-trainers', [TrainerProfileController::class, 'registeredTrainers'])->name('trainers.registered.trainers');

    // Documents
    Route::get('/trainers/documents/{profile}', [PersonalDocumentController::class, 'create'])->name('trainers.documents.create');
    Route::post('/trainers/documents', [PersonalDocumentController::class, 'store'])->name('trainers.documents.store');

    // Specializations
    Route::get('/trainers/specializations/create/{profile}/{user}', [SpecializationController::class, 'create'])->name('trainers.specializations.create');
    Route::post('/trainers/specializations', [SpecializationController::class, 'store'])->name('trainers.specializations.store');
    Route::delete('/trainers/specializations/{id}', [SpecializationController::class, 'destroy'])->name('trainers.specializations.destroy');
    Route::post('/trainers/specializations/complete', [SpecializationController::class, 'complete'])->name('trainers.specializations.complete');

    // Certifications
    Route::get('/trainers/{profile}/certifications', [CertificationController::class, 'create'])->name('trainers.certifications.create');
    Route::post('/trainers/certifications', [CertificationController::class, 'store'])->name('trainers.certifications.store');
    Route::delete('/trainers/certifications/{id}', [CertificationController::class, 'destroy'])->name('trainers.certifications.destroy');

    // Academics
    Route::get('/trainers/academics/create/{profile}', [AcademicController::class, 'create'])->name('trainers.academics.create');
    Route::post('/trainers/academics/store', [AcademicController::class, 'store'])->name('trainers.academics.store');
    Route::delete('/trainers/academics/destroy/{id}', [AcademicController::class, 'destroy'])->name('trainers.academics.destroy');

    // Work Experience
    Route::get('/trainers/work_experience/create/{profile}', [TrainerWorkExperienceController::class, 'create'])->name('trainers.work_experience.create');
    Route::post('/trainers/work_experience/store', [TrainerWorkExperienceController::class, 'store'])->name('trainers.work_experience.store');
    Route::delete('/trainers/work_experience/delete/{id}', [TrainerWorkExperienceController::class, 'delete'])->name('trainers.work_experience.delete');

    // Training Programs
    Route::get('/trainers/training_programs/create/{profile}', [TrainingProgramController::class, 'create'])->name('trainers.training_programs.create');
    Route::post('/trainers/training_programs/store', [TrainingProgramController::class, 'store'])->name('trainers.training_programs.store');
    Route::delete('/trainers/training_programs/delete/{id}', [TrainingProgramController::class, 'destroy'])->name('trainers.training_programs.delete');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
