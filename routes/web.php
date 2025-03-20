<?php

use Illuminate\Support\Facades\Route;
use App\Services\MoodleApiService;
use App\Http\Controllers\MoodleController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MoodleUserController;
use App\Http\Controllers\TrainerProfileController;




Route::get('/', function () {
    return view('welcome');
});
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('changeLang');

Route::get('/moodle/test', [MoodleController::class, 'test']);

Route::get('/moodle/users', [MoodleUserController::class, 'fetchUsers'])->name('moodle.users');
Route::get('/trainers', [TrainerProfileController::class, 'index'])->name('trainers.index');
Route::post('/moodle/users/add', [MoodleUserController::class, 'addUser'])->name('moodle.users.add');
Route::get('/trainers/create/{moodleUserId}', [TrainerProfileController::class, 'create'])->name('trainer.create');
Route::post('/trainer/store', [TrainerProfileController::class, 'store'])->name('trainer.store');






