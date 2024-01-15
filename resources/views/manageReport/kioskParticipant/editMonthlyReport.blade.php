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

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

@extends('layouts.userNav')


@section('main-content')
<div class="container2" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">

    <form action="{{ route('user.editReport', ['id' => $report->id]) }}" method="POST" enctype="multipart/form-data">
        <div class="mt-4 profile-header pr-5 pl-5 pt-3">
            <div class="text-center">
                <h4 class="font-weight-bold mx-auto mt-2 profile-title mb-4">Edit Monthly Report</h4>
            </div>

            <hr class="border-0">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Kiosk ID</b></p>
                </div>



                <select class="form-select" id="kioskValue" name="kioskValue" required>
                    @foreach($kiosks as $kiosk)
                    @if($kiosk->id == $report->kiosk_id)
                    <option value="{{ $kiosk->id }}" selected>{{ $kiosk->id }}</option>
                    @endif
                    @if($kiosk->id != $report->kiosk_id)
                    <option value="{{ $kiosk->id }}">{{ $kiosk->id }}</option>
                    @endif

                    @endforeach
                </select>
            </div>

            <hr class="border-0">


            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Monthly Sales Revenue (RM)</b></p>
                </div>

                <div class="w-25">
                    <input type="number" class="form-control" id="revenue_Ringgit" value="{{intval($report->report_monthly_revenue)}}"  name="revenue_Ringgit" placeholder="200">
                </div>

                <h1 class="ml-2 mr-2">.</h1>

                <div class="w-25">
                    <input type="number" class="form-control" id="revenue_Sen" value="{{explode('.', number_format($report->report_monthly_revenue, 2))[1]}}"  name="revenue_Sen" placeholder="00" aria-describedby="emailHelp">
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Operating Hours</b></p>
                </div>


                <div class="w-100">
                    <input type="number" class="form-control" id="optHours" name="optHours" value="{{$report->report_operating_hour}}" >
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex">
                <div class="col-3">
                    <p><b>Month</b></p>
                </div>

                <input type="date" class="w-100 form-control" id="monthPicker" value="$report->report_month"  name="monthPicker" />

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
                    <textarea name="remark" class="form-control" id="remark" cols="30" rows="5">{{$report->report_remark}}</textarea>
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex">
                <div class="col-3">
                    <p><b>Upload Documents</b></p>
                </div>


                <div class="mb-3">
                    <input class="form-control" type="file" id="formFile" value="{{$report->report_pdf}}" name="formFile">
                </div>

            </div>
        </div>

        <div class="text-center mt-5">
            @csrf
            <button type="submit" id="updateMonthlyReportBTN" class="btn pl-3 pr-3 mb-4 bg-white text-dark" data-mdb-ripple-init><b>Update</b></button>

        </div>
    </form>





</div>


<script>
    // Handle successful upload response
    $(document).ready(function() {
        $('#updateMonthlyReportBTN').click(function() {
            // Submit the form
            $(this).closest('form').submit();
        });
    });
</script>


@endsection