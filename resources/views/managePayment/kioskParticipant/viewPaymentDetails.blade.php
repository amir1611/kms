<style>
    #addPaymentBTN {
        background: linear-gradient(90deg, rgba(138, 43, 226, 1) 0%, rgba(108, 77, 224, 1) 68%, rgba(1, 11, 253, 1) 100%);
        color: white;
        border-radius: 20px;
        height: 35px;
    }

    .dropBTN {
        border-radius: 20px !important;
        border: 0 !important;
        margin-top: 2px;
    }

    .searchLogo {
        background-color: aliceblue;
        border: 0 !important;
        border-radius: 20px 0 0 20px !important;
    }

    .searchField {
        border: 0 !important;
        border-radius: 0 20px 20px 0 !important;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

@extends('layouts.userNav')


@section('main-content')
<div class="container2" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">


        <div class="mt-4 profile-header pr-5 pl-5 pt-3">
            <div class="text-center">
                <h4 class="font-weight-bold mx-auto mt-2 profile-title mb-4">Payment</h4>
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
                    <p><b>Payment Type</b></p>
                </div>
                <select class="form-select" id="payment_type" name="payment_type" disabled>
                    <option selected disabled>{{ $payment->payment_type}}</option>
                </select>
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

            <div class="text-center mt-5">
    <a href="{{ route('user.deletePayment', ['id' => $payment->payment_id]) }}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn pl-3 pr-3 mb-4 mr-3 bg-danger text-light">
        <b>Delete</b>
    </a>

    <a href="{{ route('user.viewEditPayment', ['id' => $payment->payment_id]) }}" class="btn pl-3 pr-3 mb-4 mr-3 bg-success text-light">
        <b>Edit</b>
    </a>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Delete Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you want to delete this payment?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('user.deletePayment', ['id' => $payment->payment_id]) }}">
                    <button type="button" class="btn btn-danger">Delete</button>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection