<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodleController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MoodleUserController;
use App\Http\Controllers\TrainerProfileController;
use App\Http\Controllers\PersonalDocumentController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\AcademicsController;

Route::get('/', function () {
    return view('welcome');
});

// Language Change Route
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('changeLang');

// Moodle API Test Route
Route::get('/moodle/test', [MoodleController::class, 'test']);

// Trainer Registration Routes
Route::get('/moodle/users', [MoodleUserController::class, 'fetchUsers'])->name('moodle.users');
Route::post('/moodle/users/add', [MoodleUserController::class, 'addUser'])->name('moodle.users.add');

// Trainer Profile Routes
Route::get('/trainers', [TrainerProfileController::class, 'index'])->name('trainers.index');
Route::get('/trainers/create/{moodleUserId}', [TrainerProfileController::class, 'create'])->name('trainer.create');
Route::post('/trainer/store', [TrainerProfileController::class, 'store'])->name('trainer.store');

// Document Upload Routes
Route::get('/trainers/documents/{profile}', [PersonalDocumentController::class, 'create'])->name('trainers.documents.create');
Route::post('/trainers/documents', [PersonalDocumentController::class, 'store'])->name('trainers.documents.store');

// Specialization Routes
// Removed the 'create' route because you're handling it via AJAX
Route::get('/trainers/specializations/create/{profile}/{user}', [SpecializationController::class, 'create'])->name('trainers.specializations.create');

Route::post('/trainers/specializations', [SpecializationController::class, 'store'])->name('trainers.specializations.store');
Route::delete('/trainers/specializations/{id}', [SpecializationController::class, 'destroy'])->name('trainers.specializations.destroy');
Route::post('/trainers/specializations/complete', [SpecializationController::class, 'complete'])->name('trainers.specializations.complete');


// Certification Routes
Route::get('/trainers/{profile}/certifications', [CertificationController::class, 'create'])->name('trainers.certifications.create');
Route::post('/trainers/certifications', [CertificationController::class, 'store'])->name('trainers.certifications.store');
Route::delete('/trainers/certifications/{id}', [CertificationController::class, 'destroy'])->name('trainers.certifications.destroy');

// Certification Routes


// Academic Routes
Route::get('/trainers/{profile}/academics', [AcademicsController::class, 'create'])->name('trainers.academics.create');
Route::post('/trainers/academics', [AcademicsController::class, 'store'])->name('trainers.academics.store');
