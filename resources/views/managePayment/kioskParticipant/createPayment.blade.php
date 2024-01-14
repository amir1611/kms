<style>


             
    .btn-grad {
            background-image: linear-gradient(to right, #4776E6 0%, #8E54E9  51%, #4776E6  100%);
            margin: 0px;
            padding: 15px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #000000;
            text-decoration: none;
          }
         

    /* Add your other styles here */
</style>

@extends('layouts.userNav')

@section('main-content')
    <div class="container2" style="background-color: white; border-radius: 30px; margin-left: 100px; margin-right: 100px;">

        <form action="{{ route('user.submitAddPayment') }}" method="POST" enctype="multipart/form-data">
            <div class="mt-4 profile-header pr-5 pl-5 pt-3">
                <div class="text-center">
                    <h4 class="font-weight-bold mx-auto mt-2 profile-title mb-4">Payment</h4>
                </div>

                <hr class="border-0">

                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <p><b>Kiosk ID</b></p>
                    </div>

                    <div class="w-100">
                        <input type="number" class="form-control" id="kiosk_id" name="kiosk_id"                        
                        placeholder="Enter your Kiosk ID required">
                    </div>
                </div>

                <hr class="border-0">

                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <p><b>Payment Type</b></p>
                    </div>

                    <div class="w-100">
                        <select class="form-select" id="payment_type" name="payment_type" required>
                            <option selected>Select Payment Type</option>
                            <option value="KIOSK RENT">Kiosk Rent</option>
                            <option value="INVENTORY RENT">Inventory Rent</option>
                        </select>
                    </div>
                </div>

                <hr class="border-0">

                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <p><b>Payment Amount (RM)</b></p>
                    </div>

                    <div class="w-100">
                        <input type="number" class="form-control" id="payment_amount" name="payment_amount"                            
                        placeholder="Enter payment amount" required>
                    </div>
                </div>


                <hr class="border-0">

                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <p><b>Payment Date</b></p>
                    </div>

                    <div class="w-100">
                        <input type="date" class="form-control" id="payment_date" name="payment_date"
                            required>
                    </div>
                </div>

                <hr class="border-0">

                <div class="d-flex">
                    <div class="col-3">
                        <p><b>Upload Receipt</b></p>
                    </div>

                    <div class="mb-3">
                        <p style="font-weight: bold; color: black;">Payment Receipt<span style="font-weight: bold; color: red;">*</span>
                            <span style="font-weight: bold; color: black;">(.pdf only)</span></p>
                        <input class="form-control" type="file" id="payment_receipt" name="payment_receipt" required>
                    </div>
                </div>
                <hr class="border-0">
            </div>

            <div class="text-center mt-5">
                @csrf
                <button type="submit" class="btn pl-3 pr-3 mb-4 btn-grad" style="color: #ffffff" data-mdb-ripple-init>Submit</button>
            </div>
        </form>
    </div>

    <script>
            $(document).ready(function() {
        $('.btn-grad').click(function() {
            // Submit the form
            $(this).closest('form').submit();
        });
    });
    </script>
    
@endsection
