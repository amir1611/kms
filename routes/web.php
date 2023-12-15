<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KioskController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::prefix('pupuk-admin')->name('pupuk.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified', 'user-role:pupuk-admin']], function () {
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
        Route::get('/profile', [HomeController::class, 'indexPupukAdmin'])->name('home');
        Route::post('/profile', [HomeController::class, 'updatePassword'])->name('update-password-staff');
    });
});

Route::group(['middleware' => ['auth', 'verified', 'user-role:pupuk-admin']], function () {
    Route::get('/', [HomeController::class, 'indexPupukAdmin'])->name('home');
});



Route::prefix('user')->name('user.')->group(function () {


    Route::group(['middleware' => ['auth', 'verified', 'user-role:user']], function () {
        Route::get('/profile', [HomeController::class, 'indexUser'])->name('home');
        Route::get('/viewMonthlyReportList', [ReportController::class, 'viewReportsList'])->name('reportList');
        Route::get('/uploadMonthlyReport', [ReportController::class, 'showKioskListById'])->name('uploadReport');
        Route::post('/profile', [HomeController::class, 'updatePassword'])->name('update-password-user');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');

        //manageKiosk
        Route::get('/applyKiosk', [KioskController::class, 'showApplyKioskForm'])->name('applyKiosk');
        Route::post('/applyKiosk', [KioskController::class, 'applyKiosk'])->name('submitApplyKiosk');


        Route::post('/uploadReportData', [ReportController::class, 'uploadReportData'])->name('uploadReportData');
    });
});


Route::prefix('admin')->name('admin.')->group(function () {

    Route::group(['middleware' => ['auth', 'verified', 'user-role:admin']], function () {
        Route::get('/', [HomeController::class, 'indexAdmin'])->name('home');
        Route::get('/register-staff', [UserController::class, 'registerStaff'])->name('register-staff');
        Route::post('/store-staff', [UserController::class, 'storeStaff'])->name('store-staff');
    });
});



Route::prefix('fk-technical')->name('technical.')->group(function () {

    Route::group(['middleware' => ['auth', 'verified', 'user-role:fk-technical']], function () {
        Route::get('/', [HomeController::class, 'indexFKTechnical'])->name('home');
        Route::get('/register-staff', [UserController::class, 'registerStaff'])->name('register-staff');
        Route::post('/store-staff', [UserController::class, 'storeStaff'])->name('store-staff');
    });
});

Route::prefix('fk-bursary')->name('bursary.')->group(function () {

    Route::group(['middleware' => ['auth', 'verified', 'user-role:fk-bursary']], function () {
        Route::get('/', [HomeController::class, 'indexFKBursary'])->name('home');
        Route::get('/register-staff', [UserController::class, 'registerStaff'])->name('register-staff');
        Route::post('/store-staff', [UserController::class, 'storeStaff'])->name('store-staff');
    });
});