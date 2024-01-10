<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboards\Admin\AttendanceController;
use App\Http\Controllers\Dashboards\Admin\ClassroomController;
use App\Http\Controllers\Dashboards\Admin\FeesController;
use App\Http\Controllers\Dashboards\Admin\InvoiceFeesController;
use App\Http\Controllers\Dashboards\Admin\GradeController;
use App\Http\Controllers\Dashboards\Admin\GraduationController;
use App\Http\Controllers\Dashboards\Admin\LibraryController;
use App\Http\Controllers\Dashboards\Admin\StudentPaymentController;
use App\Http\Controllers\Dashboards\Admin\ProcessingFeesController;
use App\Http\Controllers\Dashboards\Admin\PromotionController;
use App\Http\Controllers\Dashboards\Admin\ReceiptController;
use App\Http\Controllers\Dashboards\Admin\SectionController;
use App\Http\Controllers\Dashboards\Admin\SettingController;
use App\Http\Controllers\Dashboards\Admin\SubjectController;
use App\Http\Controllers\Dashboards\Admin\ParentController;
use App\Http\Controllers\Dashboards\Admin\StudentController;
use App\Http\Controllers\Dashboards\Admin\TeacherController;
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

############################################### Admin dashboard routes ##############################################################

        Route::get('/' , [HomeController::class, 'index'])->name('selection')->middleware('guest');

        ###################################### Begin Auth ###########################

            Route::group(['namespace' => 'Auth'], function () {

                Route::get('/login/{type}', [LoginController::class , 'loginForm'])->name('login.show');

                Route::post('/login-submit', [LoginController::class, 'login'])->name('login');

                Route::get('/logout/{type}', [LoginController::class , 'logout'])->name('logout');


            });

        ###################################### End Auth ###########################


    Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth']
    ], function(){


        //Admin Dashboard
        Route::get('admin/dashboard', [HomeController::class , 'adminDashboard'])->name('admin.dashboard');


        ###################################### Begin Grade ###########################

        Route::resource('grades', GradeController::class);

        Route::delete('delete-selected-grades', [GradeController::class, 'deleteSelectedGrades'])->name('delete.selected.grades');

        ###################################### End Grade ###########################



        ###################################### Begin Classroom ###########################

        Route::resource('classrooms', ClassroomController::class);

        Route::controller(ClassroomController::class)->group(function () {
            // Additional routes
            Route::delete('delete-selected-classrooms' ,  'deleteSelectedClassrooms')->name('delete.selected.classrooms');
            Route::get('filter-classes' ,  'filterClasses')->name('filter.classes');
        });

        ###################################### End Classroom ###########################



        ###################################### Begin Section ###########################

        Route::resource('sections' , SectionController::class);

        Route::get('classes/{id}' ,  [SectionController::class , 'getClases'])->name('classes');
        
        ###################################### End Section ###########################




        ###################################### Begin Parent ###########################

        Route::resource('parents', ParentController::class);

        ###################################### End Parent ###########################



        ###################################### Begin Teacher ###########################

            Route::resource('teachers', TeacherController::class);
            
            Route::controller(TeacherController::class)->group(function () {
            // Additional routes
            Route::post('teachers/upload-photo' , 'addPhotoFromDetails')->name('teacher.upload.photo');

            Route::get('teachers/open-photo/{teacherEmail}/{fileName}' , 'openPhoto')->name('teacher.open.photo');

            Route::delete('teacher/delete-photo' ,'deletePhotoFromDetails')->name('delete.teacher.photo');

            Route::get('teachers/download-photo/{teacherEmail}/{fileName}' , 'downloadPhoto')->name('download.teacher.photo');
        });

        ###################################### End Teacher ###########################




        ###################################### Begin Student ###########################
        
        Route::resource('students' , StudentController::class);

        Route::controller(StudentController::class)->group(function () {
            // Additional routes
            Route::post('students/upload-photo' ,  'addPhotoFromDetails')->name('students.upload.photo');

            Route::delete('student/delete-photo' ,  'deletePhotoFromDetails')->name('students.delete.photo');

            Route::get('students/download-photo/{studentEmail}/{fileName}' ,  'downloadPhoto')->name('student.download.photo');

            Route::get('students/open-photo/{studentEmail}/{fileName}' ,  'openPhoto')->name('student.open.photo');

            //for ajax
            Route::get('get-classrooms/{id}' ,  'getClassrooms');
            Route::get('get-sections/{id}' ,  'getSections');
        });

        ###################################### End Student ################################




        ###################################### Begin Student Promotion ###########################

        Route::resource('student-promotions' , PromotionController::class);

        Route::controller(PromotionController::class)->group(function () 
        {
            Route::post('revert-all-promotions' ,  'revertAllPromotions')->name('revert.all.promotions');
            Route::post('revert-selected-promotions',  'revertSelectedPromotions')->name('revert.selected.promotions');

            //for ajax
            Route::get('get-new-classrooms/{id}' ,  'getNewClassrooms');
            Route::get('get-new-sections/{id}' ,  'getNewSections');
        });

        ###################################### End Student Promotion ###########################




        ###################################### Begin Student Graduation #######################################
        Route::resource('graduation' , GraduationController::class);

        Route::controller(GraduationController::class)->group(function ()
        {
            Route::post('student/restored-selected', 'restored')->name('restored.selected.from.graduation');
            Route::post('graduate-selected', 'graduatedSelected')->name('graduate.selected');
        });

        ###################################### End Student Graduation #######################################



        ###################################### Begin Fees ##############################

        Route::resource('fees', FeesController::class);

        ###################################### End Fees ##############################



        ###################################### Begin FeesInvoices #######################

        Route::resource('invoices-fees', InvoiceFeesController::class);

        ###################################### End FeesInvoices #######################


        ###################################### Begin Receipt ############################

        Route::resource('student-receipt', ReceiptController::class);

        ###################################### End Receipt ############################



        ###################################### Begin ProccessingFees ############################

            Route::resource('processing-fees', ProcessingFeesController::class);

        ###################################### End ProccessingFees ############################




        ###################################### Begin Student Payment ####################

        Route::resource('student-payments', StudentPaymentController::class);

        ###################################### End Student Payment ####################




        ############################# Begin Attendance ########################

        Route::resource('attendance', AttendanceController::class);

        ############################# End Attendance ########################





        ####################### Begin Subjects ##########################

        Route::resource('subjects', SubjectController::class);

        ####################### End Subjects ##########################


        ############################ Begin Library ####################################
        Route::resource('libraries', LibraryController::class);

        Route::controller(LibraryController::class)->group(function () {
            Route::get('download-libraries/{filename}' , 'downloadBook')->name('download.book');
            Route::get('view-book/{filename}' , 'viewBook')->name('view.book');
        });
        ############################ End Library ####################################



        ###################################### Begin Settings #############################
        Route::controller(SettingController::class)->group(function () {
            Route::get('settings', 'index')->name('settings.index');
            Route::post('settings', 'update')->name('settings.update');
        });
        ###################################### Begin Settings #############################





        // ###################################### Calendar ##############################

        // Route::get('fullcalender', [FullCalenderController::class, 'index']);

        // Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);


});






