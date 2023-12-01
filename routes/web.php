<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


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
        Route::get('/viewMonthlyReportList', [HomeController::class, 'monthlyReportList'])->name('reportList');
        Route::get('/uploadMonthlyReport', [HomeController::class, 'uploadMonthlyReport'])->name('uploadReport');
        Route::post('/profile', [HomeController::class, 'updatePassword'])->name('update-password-user');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
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