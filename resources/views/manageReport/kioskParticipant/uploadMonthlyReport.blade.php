<style>
    #addMonthlyReportBTN {
        background: white;
        color: white;
        height: 35px;
        color: black;
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

    <form action="{{ route('user.uploadReportData') }}" method="POST" enctype="multipart/form-data">
        <div class="mt-4 profile-header pr-5 pl-5 pt-3">
            <div class="text-center">
                <h4 class="font-weight-bold mx-auto mt-2 profile-title mb-4">Upload Monthly Report</h4>
            </div>

            <hr class="border-0">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Kiosk ID</b></p>
                </div>



                <select class="form-select" id="kioskValue" name="kioskValue" required>
                    <option selected>Select kiosk</option>
                    @foreach($kiosks as $kiosk)
                    <option value="{{ $kiosk->id }}">{{ $kiosk->id }}</option>
                    @endforeach
                </select>
            </div>

            <hr class="border-0">


            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Monthly Sales Revenue (RM)</b></p>
                </div>

                <div class="w-25">
                    <input type="number" class="form-control" id="revenue_Ringgit" name="revenue_Ringgit" placeholder="200">
                </div>

                <h1 class="ml-2 mr-2">.</h1>

                <div class="w-25">
                    <input type="number" class="form-control" id="revenue_Sen" name="revenue_Sen" placeholder="00" aria-describedby="emailHelp">
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Operating Hours</b></p>
                </div>


                <div class="w-100">
                    <input type="number" class="form-control" id="optHours" name="optHours" placeholder="Specify the expected operating hours of the kiosk">
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex">
                <div class="col-3">
                    <p><b>Month</b></p>
                </div>

                <input type="month" class="w-100 form-control" id="monthPicker" name="monthPicker" />

                <!-- <div class="w-100">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="" aria-describedby="emailHelp">
            </div> -->
            </div>

            <hr class="border-0">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Remark</b></p>
                </div>


                <div class="w-100">
                    <textarea name="remark" class="form-control" id="remark" cols="30" rows="5" placeholder="Write something..."></textarea>
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex">
                <div class="col-3">
                    <p><b>Upload Documents</b></p>
                </div>

                <!-- <h1>{{auth()->user()->id}}</h1> -->


                <div class="mb-3">
                    <input class="form-control" type="file" id="formFile" name="formFile">
                </div>

            </div>
        </div>

        <div class="text-center mt-5">
            @csrf
            <button type="submit" id="addMonthlyReportBTN" class="btn pl-3 pr-3 mb-4" data-mdb-ripple-init><b>Submit</b></button>

        </div>
    </form>





</div>


<script>
    // Handle successful upload response
    $(document).ready(function() {
        $('#addMonthlyReportBTN').click(function() {
            // Submit the form
            $(this).closest('form').submit();
        });
    });
</script>


@endsection