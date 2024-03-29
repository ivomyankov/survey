<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\FormController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['cors'])->post('/h/{hash}', [FormController::class, 'ajaxPostForm'])->name('ajaxPostForm');

Route::middleware('auth:api')->group(function () {
    Route::get('/test/get', function () {
        echo 'Get';
    });
    
    Route::post('/test/post', function () {
        echo 'POST';
    });
});

//Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    //Route::get('/survey/{$survey}/results', [SurveyController::class, 'getResults'])->name('getResults');
    Route::patch('/survey/{survey}/reposition', [SurveyController::class, 'reposition'])->name('reposition');
    //Route::patch('/element/{element}/goto', [SurveyController::class, 'goto'])->name('goto');
    Route::patch('/element/{element}/opt', [SurveyController::class, 'opt'])->name('opt');
    Route::post('/element/{element}/test', [SurveyController::class, 'test'])->name('test');
//});

