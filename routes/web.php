<?php

use Illuminate\Support\Facades\Route;
use App\Services\MoodleApiService;
use App\Http\Controllers\MoodleController;
use App\Http\Controllers\TrainerController;


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

Route::get('/trainer/register', [TrainerController::class, 'create'])->name('trainer.register');
Route::post('/trainer/fetch', [TrainerController::class, 'fetchTrainerFromMoodle'])->name('trainer.fetch');
Route::post('/trainer/store', [TrainerController::class, 'store'])->name('trainer.store');


