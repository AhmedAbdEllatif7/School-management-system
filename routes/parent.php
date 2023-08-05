<?php

use App\Http\Controllers\school\parent\StudentController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Parent Routes
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parent/dashboard', function () {
        $sons = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.dashboard',compact('sons'));
    });


    ###################################### Student ###########################
    Route::controller(StudentController::class)->group(function () {
        Route::resource('parent-dashboard',StudentController::class);
        Route::get('parent-dashboard-attendance' ,  'getAttendance')->name('get.attendance');
        Route::get('parent-dashboard-filter', 'filterAttendances')->name('filter.attendances');
        Route::get('parent-dashboard-fees', 'fees')->name('fee.parent');
        Route::get('parent-dashboard-sons-receipt/{id}', 'receiptStudent')->name('sons.receipt');
        Route::get('parent-dashboard-profile', 'profile')->name('parent.profile');

    });


});
