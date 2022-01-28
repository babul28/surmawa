<?php

use App\Http\Controllers\College\CollegeSurveyController;
use App\Http\Controllers\College\CollegeSurveySummaryController;
use App\Http\Controllers\College\JoinSurveyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Lecturer\DashboardController;
use Illuminate\Support\Facades\Route;

$appUrl = config('app.url');

Route::domain($appUrl)->group(function () {
    Route::group(
        ['middleware' => 'respondent'],
        function () {
            Route::get('/', [HomeController::class, '__invoke'])->name('college.home');

            Route::post('/join', [JoinSurveyController::class, '__invoke'])->name('college.join.survey');

            Route::get('/surveys', [CollegeSurveyController::class, '__invoke'])
                ->middleware('already-join-survey')
                ->name('college.survey.biodata');
        }
    );

    Route::get('/surveys/summary/{respondent}', [CollegeSurveySummaryController::class, '__invoke'])->name('college.survey.summary');

    require __DIR__ . '/auth.php';
});

Route::group([
    'domain' => "lecturer.$appUrl",
    'as' => 'lecturer.',
    'middleware' => ['auth'],
], function () {
    Route::get('/', [DashboardController::class, '__invoke'])->name('index');
});
