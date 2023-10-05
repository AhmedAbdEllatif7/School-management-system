<?php

use App\Http\Controllers\school\admin\ExamController;
use App\Http\Controllers\school\student\ProfileController;
use Illuminate\Support\Facades\Auth;
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

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ], function () {

    //==============================dashboard============================
    Route::get('/student/dashboard', function () {
        $student = \App\Models\Student::where('id' , Auth::user()->id)->first();
        $subjects = \App\Models\Subject::where('grade_id' , $student->grade_id)->where('classroom_id' , $student->classroom_id)->get();
        return view('pages.Students.dashboard' , compact('subjects' , 'student'));
    });

    Route::controller(ExamController::class)->group(function () {
        Route::resource('student_exams',ExamController::class);
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::resource('student_profile',ProfileController::class);
    });



    });
