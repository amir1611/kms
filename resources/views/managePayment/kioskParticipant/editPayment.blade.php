<style>
    #editPaymentBTN {
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
    <div class="container2" style="background-color: white; border-radius: 30px; margin-left: 100px; margin-right: 100px;">

        <!-- Route to user.update based on the user id to update the user profile-->
        <form action="{{ route('user.editPayment', ['id' => $payment->payment_id]) }}" method="POST">



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

                <tr>
                        <th class="profile-label">Kiosk ID</th>
                        <td>
                            <input class="form-control profile-input" type="number" name="kiosk_id"
                                id="kiosk_id"
                                value="{{ old('kiosk_id', $payment->kiosk_id) }}">
                        </td>
                    </tr>
                
        <th class="profile-label">Payment Type</th>
            <td>
             <select class="form-control profile-input" name="payment_type" id="payment_type">
                    <option value="KIOSK RENT" {{ old('payment_type', $payment->payment_type) === 'KIOSK RENT' ? 'selected' : '' }}>
                     Kiosk Rent
                    </option>
                    <option value="INVENTORY RENT" {{ old('payment_type', $payment->payment_type) === 'INVENTORY RENT' ? 'selected' : '' }}>
                     Inventory Rent
                    </option>
                </select>
            </td>
        </tr>

                    <tr>
                        <th class="profile-label">Payment Amount (RM)</th>
                        <td>
                            <input class="form-control profile-input" type="number" name="payment_amount"
                                id="payment_amount"
                                value="{{ old('payment_amount', $payment->payment_amount) }}">
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


                    <!-- Add more fields as needed -->
                </table>
            </div>
            <div class="text-center mt-5">
            @csrf
            <button type="submit" id="editPaymentBTN" class="btn pl-3 pr-3 mb-4 bg-white text-dark" data-mdb-ripple-init><b>Update</b></button>

        </div>
            <br>
            <br>
        </form>
    </div>

    <script>
    // Handle successful upload response
    $(document).ready(function() {
        $('#editPaymentBTN').click(function() {
            // Submit the form
            $(this).closest('form').submit();
        });
    });
</script>

@endsection
