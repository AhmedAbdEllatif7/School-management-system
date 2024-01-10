<?php

use App\Http\Controllers\Dashboards\Parent\ParentController;
use App\Http\Controllers\Dashboards\Parent\ProfileController;
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

###################################### Translate all pages ######################################
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    ###################################### dashboard ######################################


    ###################################### Student ###########################

    Route::controller(ParentController::class)->group(function () {
        Route::get('/parent/dashboard', 'dashboard')->name('parent.dashboard');
        Route::get('parent/sons', 'getSons')->name('sons.index');
        Route::get('parent/sons/exams/result/{son_id}', 'viewExamsResult')->name('view.exam.result');
        Route::get('parent/sons/attendance', 'getAttendance')->name('get.attendance');
        Route::get('parent/reports/search', 'reportSearch')->name('reports.attendances');
        Route::get('parent/sons/fees', 'getSonsFees')->name('sons.fees');
        Route::get('parent/sons/receipt/{id}', 'getSonsReceipt')->name('sons.receipt');
        Route::get('parent-dashboard-profile', 'profile')->name('parent.profile');
    });


    Route::controller(ProfileController::class)->group(function () {
        Route::get('parent/profile', 'index')->name('parent.profile');
        Route::post('parent/profile/{id}', 'update')->name('parent.profile.update');

    });


});
