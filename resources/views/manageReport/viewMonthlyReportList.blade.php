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

@php
use Illuminate\Support\Str;
@endphp

<div class="container2" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">

    <div class="row mt-4 profile-header">
        <h4 class="font-weight-bold mx-auto mt-2 profile-title">Monthly Report List</h4>
    </div>


</div>


<div class="container2 p-5" style="background-color: white;border-radius: 30px;margin-top: 20px;margin-bottom: 20px;margin-left: 100px;margin-right: 100px;">

    <div class="d-flex justify-content-between align-items-center">
        <h4><b>All Monthly Report</b></h4>

        <div class="d-flex">
            <form class="d-flex input-group w-auto mr-4">

                <span class="input-group-text searchLogo bg-light" id="search-addon">
                    <i class="fas fa-search"></i>
                </span>

                <input type="search" class="form-control searchField bg-light" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />

            </form>

            <div class="dropdown mr-4  dropBTN">
                <button class="btn bg-light dropdown-toggle dropBTN" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort by: <b>Month</b>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Month</a></li>
                    <li><a class="dropdown-item" href="#">Asc</a></li>
                    <li><a class="dropdown-item" href="#">Desc</a></li>
                </ul>
            </div>

            <a href="{{route('user.uploadReport')}}"><button type="button" id="addMonthlyReportBTN" class="btn pl-3 pr-3" data-mdb-ripple-init><b>+</b></button></a>
        </div>


    </div>

    <table class="table align-middle mb-0 bg-white">
        <thead class="">
            <tr>
                <th>Kiosk ID</th>
                <th>Month</th>
                <th>Sale Revenue (RM)</th>
                <th>Report</th>
                <th>Remark</th>
                <th>Status</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>

            @foreach($reports as $report)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <p class="fw-bold mb-1">{{ $report->kiosk_id }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <p class="fw-normal mb-1">{{ $report->report_month->format('M') }}</p>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{ $report->report_monthly_revenue }}</p>
                </td>
                <td>

                    <a href="{{ asset('storage/' . $report->report_pdf) }}" target="_blank">
                        <p>{{ Str::limit($report->report_pdf, $limit = 20, $end = '...') }}</p>
                    </a>

                </td>
                <td class="w-25">{{ $report->report_remark }}</td>
                <td>
                    @if($report->report_status == "Approve")
                    <p class="text-success">{{ $report->report_status }}</p>

                    @elseif ($report->report_status == "Reject")
                    <p class="text-danger">{{ $report->report_status }}</p>

                    @else
                     <p class="text-warning">{{ $report->report_status }}</p>

                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-between">
                        <a href="#"><i class="fas fa-eye text-dark"></i></a>
                        <a href="#"><i class="fas fa-pen-to-square text-dark"></i></a>
                        <a href="#"><i class="far fa-circle-xmark text-danger"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach



        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-5 ">
        <p style="color: rgb(182, 182, 182);">Showing data 1 to 4 of 100 entries</p>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item ">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>



@endsection