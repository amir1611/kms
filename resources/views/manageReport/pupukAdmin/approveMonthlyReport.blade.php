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

@extends('layouts.pupukAdminNav')


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
            <input type="number" class="form-control" id="revenue_Ringgit" value="{{ $report->kiosk_id }}" disabled name="revenue_Ringgit" placeholder="200">
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
                <textarea name="remark" class="form-control" id="remark" disabled cols="30" rows="5">{{$report->report_remark}}</textarea>
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

        <form action="{{ route('pupuk.editReport', ['id' => $report->id]) }}" method="post">

            <div class="d-flex align-items-center">
                <div class="col-3">
                    <p><b>Status</b></p>
                </div>

                <select class="form-select" name="status" id="statusDropdown">
                    <option value="Under Review" {{ $report->report_status == 'Under Review' ? 'selected' : '' }}>Under Review</option>
                    <option value="Approve" {{ $report->report_status == 'Approve' ? 'selected' : '' }}>Approve</option>
                    <option value="Reject" {{ $report->report_status == 'Reject' ? 'selected' : '' }}>Reject</option>
                </select>
            </div>

            <hr class="border-0">

            <div id="remarkSection" style="display: none;">

                <div class="d-flex">
                    <div class="col-3">
                        <p><b>Suggestion</b></p>
                    </div>
                    <div class="w-100">
                        <textarea name="suggest" class="form-control" id="suggest" cols="30" rows="5">{{$report->report_suggestion}}</textarea>
                    </div>
                </div>

            </div>

            <div class="text-center mt-5">
                @csrf
                <button type="submit" id="updateMonthlyReportBTN" class="btn pl-3 pr-3 mb-4 bg-white text-dark" data-mdb-ripple-init><b>Submit</b></button>

            </div>
        </form>
    </div>




</div>




<script>
    $(document).ready(function() {
        // Listen for changes in the dropdown
        $('#statusDropdown').change(function() {
            // Get the selected value
            var selectedValue = $(this).val();

            // Show/hide the remark section based on the selected value
            if (selectedValue === 'Reject') {
                $('#remarkSection').show();
            } else {
                $('#remarkSection').hide();
            }
        });

        // Trigger the change event on page load to set the initial visibility
        $('#statusDropdown').trigger('change');
    });
</script>


@endsection