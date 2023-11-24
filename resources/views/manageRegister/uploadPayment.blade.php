@extends('layouts.userNav')

@section('main-content')
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-control-label" for="payment">Proof of payment<span
                    class="small text-danger">*</span></label>
            <input type="text" id="payment" class="form-control"
                name="payment" placeholder="payment">
        </div>
    </div>
    <div class="text-center">
        <input class="btn profile-btn" type="submit" onclick="return confirm('Confirm registration?')"
            value="Register">
    </div>
</div>

@endsection