<a class="nav-link" href="{{route('staff.consultant.manage')}}">
    <i class="fas fa-fw fa-user"></i>
    <span>Marriage Registration</span>
</a>
</li>

<li class="nav-item ">
<a class="nav-link" href="{{route('staff.manageCard.manage')}}">
    <i class="fas fa-fw fa-user"></i>
    <span>Marriage Card</span>
=======
<a class="nav-link" href="{{route('staff.incentive.view')}}">
    <i class="fas fa-fw fa-user"></i>
    <span>{{ __('Incentive') }}</span>


    //pian
    Route::put('/manageCard/manage', [MarriageCardController::class, 'manage'])->name('manageCard.manage');
=======

    Route::get('/incentive/view', [IncentiveController::class, 'view'])->name('incentive.view');
    //Route::delete('/incentive/delete/{id}, methods={"DELETE", "GET"}', [IncentiveController::class, 'delete'])->name('incentive.delete');



    Route::get('/incentive/manage', [IncentiveController::class, 'indexInc'])->name('incentive.create');
        
    //pian 
    Route::get('/register/spouseList', [SpouseController::class, 'spouseList'])->name('register.spouseList');
    Route::get('/register/create', [ApplicationController::class, 'create'])->name('register.create');
    Route::get('/register/manageUser', [ApplicationController::class, 'manageUser'])->name('register.manageUser');
    Route::get('/card/manageUser', [MarriageCardController::class, 'manageUser'])->name('card.manageUser');
    Route::get('/card/create', [MarriageCardController::class, 'create'])->name('card.create');
    Route::get('/card/uploadPayment', [MarriageCardController::class, 'payment'])->name('card.uploadPayment');
    Route::put('/register/uploadPayment', [ApplicationController::class, 'payment'])->name('register.uploadPayment');
=======

    Route::get('/incentive/apply', [IncentiveController::class, 'indexInc'])->name('incentive.apply');
    Route::post('/incentive/insert', [IncentiveController::class, 'insert'])->name('incentive.insert');
    Route::post('/incentive/update', [IncentiveController::class, 'view2'])->name('incentive.update');