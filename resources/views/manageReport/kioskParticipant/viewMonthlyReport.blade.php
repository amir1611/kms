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


        <div class="mt-4 profile-header pr-5 pl-5 pt-3">
            <div class="text-center">
                <h4 class="font-weight-bold mx-auto mt-2 profile-title mb-4">View Monthly Report</h4>
            </div>

            <hr class="border-0">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Kiosk ID</b></p>
                </div>



                <select class="form-select" id="kioskValue" name="kioskValue" disabled>
                    <option selected disabled>{{ $report->kiosk_id }}</option>
                </select>
            </div>

            <hr class="border-0">


            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Monthly Sales Revenue (RM)</b></p>
                </div>

                <div class="w-25">
                    <input type="number" class="form-control" id="revenue_Ringgit" value="{{intval($report->report_monthly_revenue)}}" disabled name="revenue_Ringgit" placeholder="200">
                </div>

                <h1 class="ml-2 mr-2">.</h1>

                <div class="w-25">
                    <input type="number" class="form-control" id="revenue_Sen" value="{{explode('.', number_format($report->report_monthly_revenue, 2))[1]}}" disabled name="revenue_Sen" placeholder="00" aria-describedby="emailHelp">
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Operating Hours</b></p>
                </div>


                <div class="w-100">
                    <input type="number" class="form-control" id="optHours" name="optHours" value="{{$report->report_operating_hour}}" disabled>
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex">
                <div class="col-3">
                    <p><b>Month</b></p>
                </div>

                <input type="month" class="w-100 form-control" id="monthPicker" value="{{ \Carbon\Carbon::parse($report->report_month)->format('Y-m') }}" disabled name="monthPicker" />

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
                    <textarea name="remark" class="form-control" id="remark" disabled cols="30" rows="5" >{{$report->report_remark}}</textarea>
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex">
                <div class="col-3">
                    <p><b>Upload Documents</b></p>
                </div>

                <!-- <h1>{{auth()->user()->id}}</h1> -->


                <div class="mb-3">
                <a href="{{ asset('storage/' . $report->report_pdf) }}" target="_blank">
                        <p>Month Report</p>
                    </a>
                </div>

            </div>

            <hr class="border-0">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Status</b></p>
                </div>


                <div class="w-100">
                    <input type="text" class="form-control" id="optHours" name="optHours" value="{{$report->report_status}}" disabled >
                </div>
            </div>

            <hr class="border-0">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Remark</b></p>
                </div>


                <div class="w-100">
                    <textarea name="suggest" class="form-control" id="suggest" disabled cols="30" rows="5" >{{$report->report_suggestion}}</textarea>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{route('user.deleteReport', ['id' => $report->id])}}" class="btn pl-3 pr-3 mb-4 mr-3 bg-danger text-light"> <b>Delete</b></button></a>
            
            <a href="{{route('user.updateReport', ['id' => $report->id])}}" class="btn pl-3 pr-3 mb-4 bg-white text-dark" ><b>Update</b></button></a>

        </div>
  

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to delete this report?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a ><button type="button" class="btn btn-danger">Delete</button></a>
                </div>
            </div>
        </div>
    </div>


@endsection