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

    /* Add other styles here */
</style>


{{-- KP to create complaint --}}

@extends('layouts.userNav')

@section('main-content')
    <div class="container2" style="background-color: white; border-radius: 30px; margin-left: 100px; margin-right: 100px;">

        <form action="{{ route('user.submitCreatedComplaint') }}" method="post">
            @csrf

            <!-- <div class="text-right mt-5">
                <button type="button" class="btn pl-3 pr-3 mb-4 btn-grad" style="color: #ffffff" data-mdb-ripple-init>Create New</button>
            </div>

            <div class="text-right mt-2">
                <button type="button" class="btn pl-3 pr-3 mb-4 btn-grad" style="color: #ffffff" data-mdb-ripple-init>Update</button>
            </div> -->

            <div class="mt-4 profile-header pr-5 pl-5 pt-3">
                <div class="text-center">
                    <h4 class="font-weight-bold mx-auto mt-2 profile-title mb-4">KIOSK COMPLAINT</h4>
                </div>

                <hr class="border-0">

                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <p><b>Date of filling the form</b></p>
                    </div>
                    <div class="w-100">
                        <input type="date" class="form-control" id="business_create_complaint" name="business_create_complaint" required>
                    </div>
                </div>

                <hr class="border-0">

                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <p><b>Complaint's Business Name</b></p>
                    </div>
                    <div class="w-100">
                        <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Enter business name" required>
                    </div>
                </div>

                <hr class="border-0">

                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <p><b>Complaint is regarding</b></p>
                    </div>
                    <div class="w-100">
                        <select class="form-select" id="complaint_category" name="complaint_category" required>
                            <option selected>Select complaint category</option>
                            <option value="Services">Services</option>
                            <option value="Tools">Tools</option>
                            <option value="Fees">Fees</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </div>

                <hr class="border-0">

                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <p><b>Specific details about complaint</b></p>
                    </div>
                    <div class="w-100">
                        <textarea name="complaint_information" class="form-control" id="complaint_information" cols="30" rows="5" placeholder="Describe the complaints"></textarea>
                    </div>
                </div>

                <hr class="border-0">
            </div>

            <div class="text-center mt-5">
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
