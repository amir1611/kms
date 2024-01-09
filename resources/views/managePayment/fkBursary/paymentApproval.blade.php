@extends('layouts.fkBursaryNav')

@section('main-content')
    <div class="container">
        <h2 class="mt-4">Payment Approval</h2>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Payment Info</h4>
                        <p><strong>Payment ID:</strong> {{ $payment->payment_id }}</p>
                        <p><strong>Kiosk ID:</strong> {{ $payment->kiosk_id }}</p>
                        <p><strong>Payment Type:</strong> {{ $payment->payment_type }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Phone Number:</strong> {{ $user->contact }}</p>

                        <p>
                            <strong>Payment Receipt:</strong>
                            <a href="{{ asset('storage/payments/' . basename($payment->payment_receipt)) }}"
                                target="_blank">
                                {{ basename($payment->payment_receipt) }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

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
