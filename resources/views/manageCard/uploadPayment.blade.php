@extends('layouts.userNav')

@section('main-content')
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-control-label" for="payment">Proof of payment<span
                    class="small text-danger">*</span></label>
            <input type="file" id="payment" class="form-control"
                name="payment" placeholder="payment">
        </div>
    </div>
</div>
<br><br>
    <div class="text-center">
        <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('user.card.manageUser')}}'">Confirm Payment</button>
    </div>

@endsection