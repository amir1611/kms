<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\IncentiveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrepCourseController;

use App\Http\Controllers\MarriageCardController;
use App\Http\Controllers\SpouseController;
use App\Models\Application;

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

Route::prefix('staff')->name('staff.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified', 'user-role:staff']], function () {
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
        Route::get('/profile', [HomeController::class, 'indexStaff'])->name('home');
        Route::post('/profile', [HomeController::class, 'updatePassword'])->name('update-password-staff');
        Route::get('/consultation/manage', [ConsultationController::class, 'manage'])->name('consultation.manage');
        Route::match(['GET', 'PUT'], '/consultation/decline/{id}',  [ConsultationController::class, 'decline'])->name('consultation.decline');
        Route::get('/consultation/show/{id}', [ConsultationController::class, 'show'])->name('consultation.show');
        Route::put('/consultation/update/{id}', [ConsultationController::class, 'update'])->name('consultation.update');
        Route::get('/consultation/{id}/edit', [ConsultationController::class, 'edit'])->name('consultation.edit');

        Route::get('template/{fileName}', [ConsultationController::class, 'displayFile'])->name('file.display');
        Route::delete('/consultant/destroy/{id}', [ConsultantController::class, 'destroy'])->name('consultant.destroy');
        Route::put('/consultant/update/{id}', [ConsultantController::class, 'update'])->name('consultant.update');
        Route::get('/consultant/{id}/edit', [ConsultantController::class, 'edit'])->name('consultant.edit');
        Route::get('/consultant/show/{id}', [ConsultantController::class, 'show'])->name('consultant.show');
        Route::get('/consultant/manage', [ConsultantController::class, 'manage'])->name('consultant.manage');
        Route::get('/consultant/create', [ConsultantController::class, 'create'])->name('consultant.create');
        Route::put('/consultant/store', [ConsultantController::class, 'store'])->name('consultant.store');

        Route::get('/incentive/view', [IncentiveController::class, 'view'])->name('incentive.view');
        Route::delete('/incentive/delete/{id}', [IncentiveController::class, 'delete'])->name('incentive.delete');
        Route::get('/prepCourse/applicantList', [PrepCourseController::class, 'show'])->name('prepCourse.applicantList');
        Route::get('/incentive/view', [IncentiveController::class, 'view'])->name('incentive.view');
        Route::get('/incentive/delete/{id}', [IncentiveController::class, 'delete'])->name('incentive.delete');
        //Route::delete('/incentive/delete/{id}, methods={"DELETE", "GET"}', [IncentiveController::class, 'delete'])->name('incentive.delete');
        Route::get('/register/manage', [ApplicationController::class, 'manReg'])->name('register.manage');
        Route::get('/card/manage', [MarriageCardController::class, 'manage'])->name('card.manage');

    });
});

Route::group(['middleware' => ['auth', 'verified', 'user-role:staff']], function () {
    Route::get('/', [HomeController::class, 'indexStaff'])->name('home');
});



Route::prefix('user')->name('user.')->group(function () {


    Route::group(['middleware' => ['auth', 'verified', 'user-role:user']], function () {
        Route::get('/profile', [HomeController::class, 'indexUser'])->name('home');
        Route::post('/profile', [HomeController::class, 'updatePassword'])->name('update-password-user');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
        Route::get('/consultation/manage', [ConsultationController::class, 'userManage'])->name('consultation.manage');
        Route::get('/consultation/create', [ConsultationController::class, 'create'])->name('consultation.create');
        Route::put('/consultation/store', [ConsultationController::class, 'store'])->name('consultation.store');

        Route::get('/prepCourse/payment', [PrepCourseController::class, 'createForm']);
        Route::post('/prepCourse/payment', [PrepCourseController::class, 'payment'])->name('prepCourse.payment');

        Route::get('/application/manageMarReq', [ApplicationController::class, 'manageMarReq'])->name('application.manageMarReq');
        Route::get('/application/createMarReq', [ApplicationController::class, 'createMarReq'])->name('application.createMarReq');
        Route::put('/application/storeMarReq', [ApplicationController::class, 'storeMarReq'])->name('application.storeMarReq');

        Route::get('/application/document', [ApplicationController::class, 'createForm']);
        Route::post('/application/document', [ApplicationController::class, 'document'])->name('application.document');
        Route::get('template/{fileName}', [ConsultationController::class, 'displayFile'])->name('file.display');
        Route::get('/consultation/{id}/show', [ConsultationController::class, 'userShow'])->name('consultation.show');
        Route::get('/prepCourse/manage', [PrepCourseController::class, 'manage'])->name('prepCourse.manage');
        Route::get('/prepCourse/create/{id}', [PrepCourseController::class, 'create'])->name('prepCourse.create');
        Route::put('/prepCourse/store', [PrepCourseController::class, 'store'])->name('prepCourse.store');

        Route::get('/incentive/manage', [IncentiveController::class, 'indexInc'])->name('incentive.create');
        Route::get('/incentive/apply', [IncentiveController::class, 'indexInc'])->name('incentive.apply');
        Route::post('/incentive/insert', [IncentiveController::class, 'insert'])->name('incentive.insert');
        Route::post('/incentive/update', [IncentiveController::class, 'view2'])->name('incentive.update');
        Route::get('/register/spouseList', [SpouseController::class, 'spouseList'])->name('register.spouseList');
        Route::get('/register/create', [ApplicationController::class, 'create'])->name('register.create');
        Route::get('/register/manageUser', [ApplicationController::class, 'manageUser'])->name('register.manageUser');
        Route::get('/card/manageUser', [MarriageCardController::class, 'manageUser'])->name('card.manageUser');
        Route::get('/card/create', [MarriageCardController::class, 'create'])->name('card.create');
        Route::get('/card/uploadPayment', [MarriageCardController::class, 'payment'])->name('card.uploadPayment');
        Route::put('/register/uploadPayment', [ApplicationController::class, 'payment'])->name('register.uploadPayment');



    });
});


Route::prefix('admin')->name('admin.')->group(function () {

    Route::group(['middleware' => ['auth', 'verified', 'user-role:admin']], function () {
        Route::get('/', [HomeController::class, 'indexAdmin'])->name('home');
        Route::get('/register-staff', [UserController::class, 'registerStaff'])->name('register-staff');
        Route::post('/store-staff', [UserController::class, 'storeStaff'])->name('store-staff');
    });
});
