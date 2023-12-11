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
use App\Http\Controllers\school\admin\QuestionController;
use App\Http\Controllers\school\admin\QuizController;
use App\Http\Controllers\school\admin\ReceiptController;
use App\Http\Controllers\school\admin\SectionController;
use App\Http\Controllers\school\admin\SettingController;
use App\Http\Controllers\school\admin\SubjectController;
use App\Http\Controllers\school\parent\ParenttController;
use App\Http\Controllers\school\student\StudentController;
use App\Http\Controllers\school\teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        Route::controller(SectionController::class)->group(function () {
            Route::resource('sections',SectionController::class);
            Route::get('classes/{id}' ,  'getClases')->name('classes');


        });



        ###################################### Parent ###########################
        Route::controller(ParenttController::class)->group(function () {
            Route::resource('parents',ParenttController::class);

        });



        ###################################### Teacher ###########################
        Route::controller(TeacherController::class)->group(function () {
            Route::get('teachers' , 'index')->name('teachers');
            Route::get('add_teachers' , 'addTeacher')->name('addTeacher');
            Route::get('edit_teacher_form' , 'editTeacherForm')->name('edit_teacher_form');
            Route::get('view_teacher_data/{id}' , 'viewTeacherData')->name('viewTeacherData');
            Route::post('submit_adding_teachers' , 'storeTeacher')->name('submitAddTeacher');
            Route::post('delete_attachment_teacher' , 'deleteFileTeacher');
            Route::post('submit_edit' , 'submitEdit')->name('submit_edit');
            Route::post('upload_teacher_file' , 'uploadTeacherFile')->name('uploadTeacherFile');
            Route::post('delete_teacher' , 'deleteTeacher')->name('delete_teacher');
            Route::get('download_teacher_file/{teacher_name}/{filename}' ,  'downloadTeacherFile');


        });


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


        ###################################### Quizzes ###########################
        Route::controller(QuizController::class)->group(function () {
            Route::resource('quizzes',QuizController::class);
        });


        ###################################### Questions ###########################
        Route::controller(QuestionController::class)->group(function () {
            Route::resource('questions',QuestionController::class);
        });


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






