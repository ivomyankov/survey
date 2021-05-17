<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard2', function () {
    return view('dashboard2');
})->name('dashboard2');

Route::get('/survey/{survey}', [FormController::class, 'buildSurvey'])->name('buildSurvey');

Route::post('/survey/{survey}/submit', [FormController::class, 'submitSurvey'])->name('submitSurvey');

Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard/')->group(function () {
    Route::get('/', [SurveyController::class, 'dashboard'])->name('dashboard');
    Route::get('surveys', [SurveyController::class, 'getSurveys'])->name('getSurveys');
    Route::get('survey', [SurveyController::class, 'newSurvey'])->name('newSurvey');
    Route::get('survey/{survey}', [SurveyController::class, 'getSurvey'])->name('getSurvey');
    Route::get('survey/{survey}/results', [SurveyController::class, 'getResults'])->name('getResults');
});


