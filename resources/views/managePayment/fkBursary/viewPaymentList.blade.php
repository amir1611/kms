<style>
    #addMonthlyReportBTN {
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
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@extends('layouts.fkBursaryNav')

@section('main-content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="row mt-4 profile-header">
        <h4 class="font-weight-bold mx-auto mt-2 profile-title">PAYMENT</h4>
    </div>

    <div class="container2 p-1" style="background-color: white;border-radius: 30px;margin: 20px 100px;">



        <div class="d-flex justify-content-between align-items-center mt-3">
            <h4 style="margin-left: 20px"><b>Payment List</b></h4>

            <div class="d-flex">
                <form class="d-flex input-group w-auto mr-4" method="get" action="{{ route('bursary.viewAllPayment') }}">

                    <span class="input-group-text searchLogo bg-light" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>

                    <input type="search" class="form-control searchField bg-light" name="search"
                        value="{{ $currentSearch ?? '' }}" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" />

                </form>

                <div class="dropdown mr-4 dropBTN">
                    <button class="btn bg-light dropdown-toggle dropBTN" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by: <b>Status</b>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item"
                                href="{{ route('bursary.viewAllPayment', ['sort' => 'All']) }}">All</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('bursary.viewAllPayment', ['sort' => 'Pending']) }}">Pending</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('bursary.viewAllPayment', ['sort' => 'Approved']) }}">Approved</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('bursary.viewAllPayment', ['sort' => 'Rejected']) }}">Rejected</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <table class="table align-middle mb-0 bg-white text-center">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Kiosk ID</th>
                    <th>Payment Type</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kioskPayments as $payment)
                    <tr>
                        <td>{{ $payment->payment_id }}</td>
                        <td>{{ $payment->kiosk_id }}</td>
                        <td>{{ $payment->payment_type }}</td>
                        <td>{{ $payment->email }}</td>
                        <td>{{ $payment->contact }}</td>
                        <td>{{ $payment->created_at }}</td>
                        <td>{{ $payment->updated_at}}</td>
                        <td>{{ $payment->payment_comment}}</td>
                        <td>
                            @if ($payment->payment_status == 'Pending')
                                <p
                                    style="border-radius: 4px; border: 1px solid #000; background: rgba(0, 255, 195, 0.38); color:black;">
                                    {{ $payment->payment_status }}</p>

                            @elseif ($payment->payment_status == 'Approved')
                                <p
                                    style="border-radius: 4px; border: 1px solid #000; background: rgba(106, 0, 255, 0.38); color:black;">
                                    {{ $payment->payment_status }}</p>

                            @elseif ($payment->payment_status == 'New')
                                <p
                                    style="border-radius: 4px; border: 1px solid #000; background: rgba(255, 242, 0, 0.38); color:black;">
                                    {{ $payment->payment_status }}</p>

                            @elseif ($payment->payment_status == 'Rejected')
                                <p
                                    style="border-radius: 4px; border: 1px solid #000; background: rgba(255, 0, 0, 0.38); color:black;">
                                    {{ $payment->payment_status }}</p>
                            @else
                                <p class="text-warning">{{ $payment->payment_status }}</p>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                    <a
                                        href="{{ route('bursary.paymentApproval', ['id' => $payment->payment_id]) }}">
                                        <i class="fas fa-eye text-dark"></i>
                                    </a>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-5">
            <p style="color: rgb(182, 182, 182);">Showing data {{ $kioskPayments->firstItem() }} to
                {{ $kioskPayments->lastItem() }} of {{ $kioskPayments->total() }} entries</p>
            {{ $kioskPayments->links() }}
        </div>
    </div>
@endsection
