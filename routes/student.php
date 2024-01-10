<?php

use App\Http\Controllers\Dashboards\Student\ProfileController;
use App\Http\Controllers\Dashboards\Student\StudentController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


######################### Translate all pages #########################
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ], function () {

    ######################### dashboard y##############################
    Route::controller(StudentController::class)->group(function ()
    {
        Route::get('/student/dashboard', 'index')->name('students.index');
        Route::get('/student/exams/', 'getExams')->name('student.exams.show');
        Route::get('/student/questions/{quiz_id}', 'getQuestions')->name('student.questions.show');
        
    });



    Route::controller(ProfileController::class)->group(function () {
        Route::get('/student/profile', 'getProfile')->name('student.profile');
        Route::post('/student/update-profile/{id}', 'updateProfile')->name('student.profile.update');    });
    });
