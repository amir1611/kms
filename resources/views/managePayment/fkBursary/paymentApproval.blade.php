@extends('layouts.fkBursaryNav')

@section('main-content')
<div class="container2" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">


<div class="mt-4 profile-header pr-5 pl-5 pt-3">
    <div class="text-center">
        <h4 class="font-weight-bold mx-auto mt-2 profile-title mb-4">Payment Approval</h4>
    </div>

    <hr class="border-0">
    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Payment ID</b></p>
        </div>
        <div class="w-100">
            <input type="number" class="form-control" id="payment_id" name="payment_id" value="{{ $payment->payment_id }}" disabled>
        </div>
    </div>

    <hr class="border-0">

    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Kiosk ID</b></p>
        </div>

        <div class="w-100">
            <input type="number" class="form-control" id="kiosk_id" name="kiosk_id" value="{{$payment->kiosk_id}}" disabled>
        </div>
    </div>

    <hr class="border-0">

    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Email</b></p>
        </div>

        <div class="w-100">
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" disabled>
        </div>
    </div>

    <hr class="border-0">

    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Contact</b></p>
        </div>

        <div class="w-100">
            <input type="number" class="form-control" id="contact" name="contact" value="{{$user->contact}}" disabled>
        </div>
    </div>

    <hr class="border-0">

    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Name</b></p>
        </div>

        <div class="w-100">
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" disabled>
        </div>
    </div>
    
    
    <hr class="border-0">

    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Payment Type</b></p>
        </div>

        <div class="w-100">
            <input type="text" class="form-control" id="payment_type" name="payment_type" value="{{$payment->payment_type}}" disabled>
        </div>
    </div>
    
    <hr class="border-0">

    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Payment Amount</b></p>
        </div>

        <div class="w-100">
            <input type="number" class="form-control" id="payment_amount" name="payment_amount" value="{{$payment->payment_amount}}" disabled>
        </div>
    </div>

    <hr class="border-0">

    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Payment Date</b></p>
        </div>

        <div class="w-100">
            <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{$payment->payment_date}}" disabled >
        </div>
     </div>

    <hr class="border-0">

    <div class="d-flex">
        <div class="col-3">
            <p><b>Payment Receipt</b></p>
        </div>

        <div class="mb-3">
            <a href="{{ asset('storage/' . $payment->payment_receipt) }}" target="_blank" @if(pathinfo($payment->payment_receipt, PATHINFO_EXTENSION) == 'pdf') download @endif>
                <p>Receipt</p>
            </a>
        </div>
    </div>

    <hr class="border-0">

    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Created At</b></p>
        </div>

        <div class="w-100">
            <input type="datetime" class="form-control" id="created_at" name="created_at" value="{{$payment->created_at}}" disabled >
        </div>
     </div>

     <hr class="border-0">

    <div class="d-flex align-items-center">
        <div class="col-3">
            <p><b>Updated At</b></p>
        </div>

        <div class="w-100">
            <input type="datetime" class="form-control" id="updated_at" name="updated_at" value="{{$payment->updated_at}}" disabled >
        </div>
     </div>


    <hr class="border-0">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Comments(Optional)</h4>
                        <form method="post"
                            action="{{ route('bursary.processPayment', ['id' => $payment->payment_id]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="payment_comment" class="form-label">Comments:</label>
                                <textarea class="form-control" name="payment_comment" id="payment_comment" rows="3"></textarea>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="submit" class="btn btn-success" name="action"
                                    value="approve">Approve</button>
                                <button type="submit"class="btn btn-danger" style="margin-left: 20px" name="action"
                                    value="reject">Reject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
@endsection
