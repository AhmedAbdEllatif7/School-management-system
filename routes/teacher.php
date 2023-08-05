<?php

use App\Http\Controllers\school\AttendanceController;
use App\Http\Controllers\school\SectionController;
use App\Http\Controllers\school\SettingController;
use App\Http\Controllers\school\student\StudentController;
use App\Http\Controllers\school\teacher\ProfileController;
use App\Http\Controllers\school\teacher\QuestionsController;
use App\Http\Controllers\school\teacher\QuizController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Teacher Routes
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {

        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['count_sections']= $ids->count();
        $data['count_students']= \App\Models\Student::whereIn('section_id',$ids)->count();

//        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
//        $count_sections =  $ids->count();
//        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();
        return view('pages.Teachers.dashboard',$data);
    });

    ###################################### Section ###########################
    Route::controller(SectionController::class)->group(function () {
        Route::resource('sections-teacher',SectionController::class);
    });

    ###################################### Settings ###########################
//    Route::controller(SettingController::class)->group(function () {
//        Route::get('settings-teacher', 'index')->name('setting');
//        Route::post('settings', 'update')->name('updateSetting');
//    });

    ###################################### Student ###########################
    Route::controller(StudentController::class)->group(function () {
        Route::resource('students-teacher',StudentController::class);

        Route::get('student-information' , 'studentInformation')->name('studentInformation');
        Route::get('section-information' , 'sectionInformation')->name('sectionInformation');
    });


    ###################################### Attendance ###########################
    Route::controller(AttendanceController::class)->group(function () {
        Route::resource('attendance-teacher',AttendanceController::class);
        Route::post('edit_student_presence/{id}' , 'editStudentPresence')->name('editStudentPresence');
        Route::get('get-attendance', 'getAttendance')->name('attendances');
        Route::get('attendance-report', 'attendanceReport')->name('attendanceReport');
        Route::get('attendance-search', 'attendanceSearch')->name('attendance.search');
    });



    ###################################### Quizzes ###########################
    Route::controller(QuizController::class)->group(function () {
        Route::resource('quizzes-teacher',QuizController::class);
        Route::get('students_that_exammed/{quiz_id}','getStudentThatExammed')->name('student.exammed');
        Route::post('students_that_exammed','repeatExam')->name('exam.repeat');

    });


    ###################################### Questions ###########################
    Route::controller(QuestionsController::class)->group(function () {
        Route::resource('questions-teacher',QuestionsController::class);
    });


    Route::get('profile', [ProfileController::class , 'index'])->name('profile.show');
    Route::post('profile/{id}', [ProfileController::class , 'update'])->name('profile.update');


});
