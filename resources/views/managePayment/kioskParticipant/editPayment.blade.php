@extends('layouts.userNav')

@section('main-content')
    <div class="container2" style="background-color: white; border-radius: 30px; margin-left: 100px; margin-right: 100px;">

        <!-- Route to user.update based on the user id to update the user profile-->
        <form action="{{ route('user.editPayment', ['id' => $payment>payment_id]) }}" method="POST">



            <!-- Cross Site Request Forgery Protection -->
            @csrf
            <!-- Override form method to PUT -->
            @method('PUT')

            <div class="row mt-4 profile-header">
                <h4 class="font-weight-bold mx-auto mt-2 profile-title text-center">Edit Payment</h4>
            </div>

            <div class="table-responsive">
                <table class="table mt-3 profile-table">
                    <tr>
                        <th class="profile-label">Payment Type</th>
                        <td>
                            <select class="form-control profile-input" name="payment_type" id="payment_type">
                                <option value="KIOSK RENT"
                                    {{ old('payment_type', $payment->payment_type) === 'KIOSK RENT' ? 'selected' : '' }}>
                                    Kiosk Rent</option>
                                <option value="INVENTORY RENT"
                                    {{ old('payment_rent', $payment->payment_type) === 'INVENTORY RENT ? 'selected' : '' }}>
                                    Inventory Rent</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="profile-label">Payment Amount (RM)</th>
                        <td>
                            <input class="form-control profile-input" type="number" name="payment_amount"
                                id="payment_amount"
                                value="{{ old('payment_amount', $apayment->payment_amount) }}">
                        </td>
                    </tr>
                    <tr>
                        <th class="profile-label">Payment Date</th>
                        <td>
                            <input class="form-control profile-input" type="date" name="payment_date"
                                id="payment_date"
                                value="{{ old('payment_date', $payment->payment_date) }}">
                        </td>
                    </tr>

                    <tr>
                        <th class="profile-label">Payment Receipt</th>
                        <td>
                        <p style="font-weight: bold; color: black;">Payment Receipt<span style="font-weight: bold; color: red;">*</span>
                            <span style="font-weight: bold; color: black;">(.pdf only)</span></p>
                        <input class="form-control" type="file" id="payment_receipt" name="payment_receipt" required>
                        </td>
                    </tr>

                    <!-- Add more fields as needed -->
                </table>
            </div>
            <div class="text-center">
                <input class="btn profile-btn" type="submit"
                    onclick="return confirm('Confirm to update payment information?')" value="Update">
            </div>
            <br>
            <br>
        </form>
    </div>
@endsection
