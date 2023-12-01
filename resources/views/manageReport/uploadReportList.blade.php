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

@extends('layouts.userNav')


@section('main-content')
<div class="container2" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">

    <div class="mt-4 profile-header pr-5 pl-5 pt-3">
        <div class="text-center">
            <h4 class="font-weight-bold mx-auto mt-2 profile-title mb-4">Upload Monthly Report</h4>
        </div>

        <hr class="border-0">

        <div class="d-flex align-items-center">
            <div class="col-3">
                <p><b>Monthly Sales Revenue (RM)</b></p>
            </div>

            <div class="w-25">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="200" aria-describedby="emailHelp">
            </div>

            <h1 class="ml-2 mr-2">.</h1>

            <div class="w-25">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="00" aria-describedby="emailHelp">
            </div>
        </div>

        <hr class="border-0">

        <div class="d-flex align-items-center">
            <div class="col-3">
                <p><b>Operating Hours</b></p>
            </div>

            <div class="w-100">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Specify the expected operating hours of the kiosk" aria-describedby="emailHelp">
            </div>
        </div>

        <hr class="border-0">

        <div class="d-flex">
            <div class="col-3">
                <p><b>Month</b></p>
            </div>

            <div class="w-100">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Provide an estimated date when you plan to start operating the kiosk" aria-describedby="emailHelp">
            </div>
        </div>

        <hr class="border-0">

        <div class="d-flex">
            <div class="col-3">
                <p><b>Upload Documents</b></p>
            </div>


            <div class="mb-3">
                <input class="form-control" type="file" id="formFile">
            </div>

        </div>
    </div>

    <div class="text-center mt-5">
        <button type="button" id="addMonthlyReportBTN" class="btn pl-3 pr-3 mb-4 " data-mdb-ripple-init><b>Submit</b></button>
    </div>


</div>





@endsection