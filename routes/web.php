<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\PaymentController;



Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Auth::routes(['verify' => true]);


//ALL ROUTES FOR PUPUK ADMIN
Route::prefix('pupuk-admin')->name('pupuk.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified', 'user-role:pupuk-admin']], function () {

        //manageAccount
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
        Route::get('/profile', [HomeController::class, 'indexPupukAdmin'])->name('home');
        Route::post('/profile', [HomeController::class, 'updatePassword'])->name('update-password-staff');
        Route::get('/', [HomeController::class, 'indexPupukAdmin'])->name('home');

        //manageKiosk
        Route::get('/kiosk-application', [KioskController::class, 'viewKioskApplication'])->name('viewKioskApplication');
        Route::get('/view-application-approval/{id}', [KioskController::class, 'viewApplicationApproval'])->name('viewApplicationApproval');
        Route::post('/process-application/{id}', [KioskController::class, 'processApplication'])->name('processApplication');
        Route::get('/view-application/{id}', [KioskController::class, 'viewApplication'])->name('viewApplication');
        Route::get('/kiosk-participant', [KioskController::class, 'viewKioskParticipant'])->name('viewKioskParticipant');
        Route::get('/pupuk/deleteKiosk/{id}', [KioskController::class, 'deleteKiosk'])->name('deleteKiosk');
        Route::get('/pupuk/updateApplicationStatus/{id}', [KioskController::class, 'updateApplicationStatus'])->name('updateApplicationStatus');


        //manageReport
        Route::get('/viewMonthlyReportList', [ReportController::class, 'viewAllReport'])->name('reportList');
        Route::get('/uploadMonthlyReport', [ReportController::class, 'showKioskListById'])->name('uploadReport');
        Route::post('/uploadReportData', [ReportController::class, 'uploadReportData'])->name('uploadReportData');
        Route::get('/viewMonthReport/{id}', [ReportController::class, 'viewReport'])->name('viewReport');
        Route::get('/updateMonthReport/{id}', [ReportController::class, 'displayEditKioskParticipantReport'])->name('updateReport');
        Route::post('/updateMonthReport/{id}', [ReportController::class, 'editKioskParticipantReport'])->name('editReport');
        Route::get('/filter/{filterData}', [ReportController::class, 'filterTable'])->name('filterSec');
        Route::get('/search', [ReportController::class, 'searchReport'])->name('searchReport');
    });
});


//ALL ROUTES FOR KIOSK PARTICIPANT
Route::prefix('user')->name('user.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified', 'user-role:user']], function () {

        //manageAccount
        Route::get('/profile', [HomeController::class, 'indexUser'])->name('home');
        Route::post('/profile', [HomeController::class, 'updatePassword'])->name('update-password-user');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');

        //manageKiosk 
        Route::get('/applyKiosk', [KioskController::class, 'showApplyKioskForm'])->name('applyKiosk');
        Route::post('/applyKiosk', [KioskController::class, 'applyKiosk'])->name('submitApplyKiosk');
        Route::get('/applyForReject', [KioskController::class, 'rejectApplication'])->name('rejectApplication');
        Route::put('/update-kiosk/{id}', [KioskController::class, 'updateKiosk'])->name('updateKiosk');

        // managePayment
        Route::get('/viewPaymentHistory', [PaymentController::class, 'viewPaymentHistory'])->name('viewPaymentHistory');
        Route::get('/createPayment', [PaymentController::class, 'showCreatePaymentForm'])->name('createPayment');
        Route::post('/createPayment', [PaymentController::class, 'createPayment'])->name('submitCreatePayment');
        Route::get('/viewPaymentDetails/{id}', [PaymentController::class, 'viewPaymentDetails']);
        Route::get('/filter/{filterData}', [PaymentController::class, 'filterTable'])->name('filterSec');
        Route::get('/search', [PaymentController::class, 'searchPayment'])->name('searchPayment');
        Route::get('/deletePayment/{id}', [PaymentController::class, 'deletePayment'])->name('deletePayment');
        Route::get('edit-payment/{id}', [PaymentController::class, 'showEditPaymentForm'])->name('showEditPaymentForm');
        Route::put('/user/edit-payment/{id}', [PaymentController::class, 'editPayment'])->name('editPayment');


        //manageReport
        Route::get('/viewMonthlyReportList', [ReportController::class, 'viewAllKioskParticipantReport'])->name('reportList');
        Route::get('/uploadMonthlyReport', [ReportController::class, 'showKioskListById'])->name('uploadReport');
        Route::post('/uploadReportData', [ReportController::class, 'uploadReportData'])->name('uploadReportData');
        Route::get('/viewMonthReport/{id}', [ReportController::class, 'viewReport'])->name('viewReport');
        Route::get('/updateMonthReport/{id}', [ReportController::class, 'displayEditKioskParticipantReport'])->name('updateReport');
        Route::post('/updateMonthReport/{id}', [ReportController::class, 'editKioskParticipantReport'])->name('editReport');
        Route::get('/deleteMonthReport/{id}', [ReportController::class, 'deleteKioskParticipantReport'])->name('deleteReport');
        Route::get('/filter/{filterData}', [ReportController::class, 'filterTable'])->name('filterSec');
        Route::get('/search', [ReportController::class, 'searchReport'])->name('searchReport');

    });
});


//ALL ROUTES FOR ADMIN
Route::prefix('admin')->name('admin.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified', 'user-role:admin']], function () {

        //manageAccount
        Route::get('/', [HomeController::class, 'indexAdmin'])->name('home');
        Route::get('/register-staff', [UserController::class, 'registerStaff'])->name('register-staff');
        Route::post('/store-staff', [UserController::class, 'storeStaff'])->name('store-staff');
    });
});


//ALL ROUTES FOR FK TECHNICAL 
Route::prefix('fk-technical')->name('technical.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified', 'user-role:fk-technical']], function () {

        //manageAccount
        Route::get('/', [HomeController::class, 'indexFKTechnical'])->name('home');
        Route::get('/register-staff', [UserController::class, 'registerStaff'])->name('register-staff');
        Route::post('/store-staff', [UserController::class, 'storeStaff'])->name('store-staff');
    });
});


//ALL ROUTES FOR FK BURSARY
Route::prefix('fk-bursary')->name('bursary.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified', 'user-role:fk-bursary']], function () {

        //manageAccount
        Route::get('/', [HomeController::class, 'indexFKBursary'])->name('home');
        Route::get('/register-staff', [UserController::class, 'registerStaff'])->name('register-staff');
        Route::post('/store-staff', [UserController::class, 'storeStaff'])->name('store-staff');

        //managePayment
        Route::get('/viewPaymentList', [PaymentController::class, 'viewPaymentList'])->name('viewPaymentList');
        Route::get('/view-payment/{id}', [PaymentController::class, 'viewPayment'])->name('viewPayment');
        Route::get('/payment-approval/{id}', [PaymentController::class, 'paymentApproval'])->name('paymentApproval');
        Route::get('/view-payment/{id}', [PaymentController::class, 'viewPayment'])->name('viewPayment');
        Route::post('/process-payment/{id}', [PaymentController::class, 'processPayment'])->name('processPayment');
    });
});
