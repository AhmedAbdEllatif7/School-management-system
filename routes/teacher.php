<?php

use App\Http\Controllers\Dashborads\Teacher\ProfileController;
use App\Http\Controllers\Dashborads\Teacher\QuestionsController;
use App\Http\Controllers\Dashborads\Teacher\QuizController;
use App\Http\Controllers\Dashborads\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/

######################### Translate all pages ######################################
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {


    ######################### Dashboard ######################################
    Route::controller(TeacherController::class)->group(function () {
        Route::get('/teacher/dashboard', 'dashboard');
        Route::get('/teacher/sections', 'getSections')->name('sections.index');
        Route::get('/teacher/students', 'getStudents')->name('students.index');
        Route::get('/teacher/attendance', 'getAttendance')->name('attendance.index');
        Route::post('/teacher/attendance', 'storeAttendance')->name('attendance.store');
        Route::get('/teacher/reports', 'getReports')->name('reports.index');
        Route::get('/teacher/reports/search', 'reportSearch')->name('reports.search');
        
        //for ajax
        Route::get('teacher/get-classrooms/{id}' ,  'ajaxGetClassrooms');
        Route::get('teacher/get-sections/{id}' ,  'ajaxGetSections');
        });




    ######################### Quizzes ###########################
        Route::resource('quizzes', QuizController::class);


    ###################################### Questions ###########################
        Route::resource('questions', QuestionsController::class);


    ###################################### Profile ###########################
        Route::get('teacher-profile', [ProfileController::class, 'index'])->name('teacher.profile.index');
        
        Route::put('teacher-profile/{id}', [ProfileController::class, 'update'])->name('teacher.profile.update');
        


});
