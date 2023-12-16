<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\school\admin\AttendanceController;
use App\Http\Controllers\school\admin\ClassroomController;
use App\Http\Controllers\school\admin\FeesController;
use App\Http\Controllers\school\admin\FeesInvoicesController;
use App\Http\Controllers\school\admin\FullCalenderController;
use App\Http\Controllers\school\admin\GradeController;
use App\Http\Controllers\school\admin\GraduationController;
use App\Http\Controllers\school\admin\LibraryController;
use App\Http\Controllers\school\admin\PaymentStudentController;
use App\Http\Controllers\school\admin\ProccrssingFeesController;
use App\Http\Controllers\school\admin\PromotionController;
use App\Http\Controllers\school\admin\ReceiptController;
use App\Http\Controllers\school\admin\SectionController;
use App\Http\Controllers\school\admin\SettingController;
use App\Http\Controllers\school\admin\SubjectController;
use App\Http\Controllers\school\admin\ParentController;
use App\Http\Controllers\school\student\StudentController;
use App\Http\Controllers\school\admin\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Auth


Route::get('/' , [HomeController::class, 'index'])->name('selection')->middleware('guest');


Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}', [LoginController::class , 'loginForm'])->middleware('guest')->name('login.show');

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/logout/{type}', [LoginController::class , 'logout'])->name('logout');


});

    Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth']
    ], function(){


        //Admin Dashboard
        Route::get('admin/dashboard',[HomeController::class , 'adminDashboard'])->name('admin.dashboard');




        ###################################### Grade ###########################
        Route::resource('grades',GradeController::class);
        
        Route::controller(GradeController::class)->group(function () {
            Route::delete('delete-selected-grades' ,  'deleteSelectedGrades')->name('delete.selected.grades');
        });



        ###################################### Classroom ###########################
        Route::resource('classrooms',ClassroomController::class);

        Route::controller(ClassroomController::class)->group(function () {
            Route::delete('delete-selected-classrooms' ,  'deleteSelectedClassrooms')->name('delete.selected.classrooms');
            Route::get('filter-classes' ,  'filterClasses')->name('filter.classes');
        });



        ###################################### Section ###########################
        Route::resource('sections',SectionController::class);

        Route::controller(SectionController::class)->group(function () {
            Route::get('classes/{id}' ,  'getClases')->name('classes');
        });


        /*rename the parent table columns name to the best name convension
        * and rename it's livewire attrubites to match them and update strucure of
        * student parent controller and structure of livewire add parent components
        */
        ###################################### Parent ###########################
        Route::controller(ParentController::class)->group(function () {
            Route::resource('parents',ParentController::class);

        });



        ###################################### Teacher ###########################
        Route::resource('teachers', TeacherController::class);
        
        // Additional routes
        Route::delete('teacher/delete-photo', [TeacherController::class,'deleteTeacherPhoto'])->name('delete.teacher.photo');
        Route::post('teacher/upload-photos', [TeacherController::class,'uploadTeacherPhotos'])->name('teacher.upload.photo');
        Route::get('teacher/download-photo/{teacher_name}/{filename}', [TeacherController::class,'downloadTeacherPhoto'])->name('download.teacher.photo');




        ###################################### Student ###########################
        Route::controller(StudentController::class)->group(function () {
            Route::resource('students',StudentController::class);
            Route::post('update_student' ,  'update');
            Route::get('Get_new_classrooms/{id}' ,  'getNewClassroom');
            Route::get('Get_new_Sections/{id}' ,  'getNewSections');

            Route::post('upload_attachments' ,  'uploadAttachments');
            Route::post('delete_attachment' ,  'deleteAttachment');
            Route::get('download_attachments/{students_name}/{filename}' ,  'downloadAttachments');
            Route::get('view_file/{student_name}/{filename}' ,  'viewFile');


        });


        ###################################### Student ###########################
        Route::controller(PromotionController::class)->group(function () {
            Route::resource('promotion_students',PromotionController::class);
            Route::post('delete_all' ,  'deleteAll');
            Route::post('delete_one' ,  'deleteOne');
        });



        ###################################### Graduation ########################
        Route::controller(GraduationController::class)->group(function () {
            Route::resource('Graduation',GraduationController::class);
            Route::post('return_all_gradated_back', 'returnAllGraduatedBack')->name('returnAllGraduatedBack');
            Route::post('return_student', 'returnStudent')->name('returnStudent');
            Route::post('force_delete', 'ForceDelete')->name('ForceDelete');
            Route::post('graduate_selected', 'graduatedSelected')->name('graduate_selected');
            Route::get('/Get_student_email/{student_id}', 'getStudentEmail');


        });



        ###################################### Fees ##############################
        Route::controller(FeesController::class)->group(function () {
            Route::resource('fees',FeesController::class);
            Route::get('view_fees','viewFees')->name('viewFees');
        });



        ###################################### FeesInvoices #######################
        Route::controller(FeesInvoicesController::class)->group(function () {
            Route::resource('fees_invoices',FeesInvoicesController::class);
        });


        ###################################### Receipt ############################
            Route::controller(ReceiptController::class)->group(function () {
                Route::resource('receipt_student',ReceiptController::class);
            });



        ###################################### ProccessingFees ####################
        Route::controller(ProccrssingFeesController::class)->group(function () {
            Route::resource('processing_fees',ProccrssingFeesController::class);
        });




        ###################################### ProccessingFees ####################
        Route::controller(PaymentStudentController::class)->group(function () {
            Route::resource('payments_student',PaymentStudentController::class);
        });




        ###################################### Attendance ########################
        Route::controller(AttendanceController::class)->group(function () {
                Route::resource('attendance',AttendanceController::class);
                Route::post('edit_student_presence/{id}' , 'editStudentPresence')->name('editStudentPresence');
            });




        ###################################### Subjects ##########################
        Route::controller(SubjectController::class)->group(function () {
            Route::resource('subjects',SubjectController::class);
        });


        // ###################################### Quizzes ###########################
        // Route::controller(QuizController::class)->group(function () {
        //     Route::resource('quizzes',QuizController::class);
        // });


        // ###################################### Questions ###########################
        // Route::controller(QuestionController::class)->group(function () {
        //     Route::resource('questions',QuestionController::class);
        // });


        ###################################### LibraryRepository ###################
        Route::controller(LibraryController::class)->group(function () {
            Route::resource('libraries',LibraryController::class);
            Route::get('download_libraries/{filename}' , 'downloadFile')->name('downloadFileName');
            Route::get('view_libraries/{filename}' , 'viewFile')->name('viewFileName');

        });


        ###################################### Settings #############################
        Route::controller(SettingController::class)->group(function () {
            Route::get('settings', 'index')->name('view.settings');
            Route::post('settings', 'update')->name('updateSetting');


        });


        ###################################### Calendar ##############################

        Route::get('fullcalender', [FullCalenderController::class, 'index']);

        Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);


});






