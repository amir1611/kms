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


<div class="container2 p-5" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">

    <div class="row  profile-header">
        <h4 class="font-weight-bold mx-auto  profile-title">Monthly Report List</h4>
    </div>

    <canvas id="revenueChart" width="400" height="100"></canvas>
</div>


<div class="container2 p-5" style="background-color: white;border-radius: 30px;margin-top: 20px;margin-bottom: 20px;margin-left: 100px;margin-right: 100px;">

    <div class="d-flex justify-content-between align-items-center">
        <h4><b>All Monthly Report</b></h4>

        <div class="d-flex">
            <form class="d-flex input-group w-auto mr-4" action="{{ route('user.searchReport') }}" method="GET">

                <span class="input-group-text searchLogo bg-light" id="search-addon">
                    <button type="submit" class="border-0 bg-light"><i class="fas fa-search"></i></button>
                </span>

                <input type="search" class="form-control searchField bg-light" name="searchTerm" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />

            </form>
            <form action="{{ route('user.filterSec', ['filterData' => 'Month']) }}" method="GET">
                <div class="dropdown mr-4">
                    <!-- <button class="btn bg-light dropdown-toggle dropBTN" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by: <b>Month</b>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Month</a></li>
                        <li><a class="dropdown-item" href="#">Asc</a></li>
                        <li><a class="dropdown-item" href="#">Desc</a></li>
                        <option value="">All</option> -->
                    <select name="filterData" class="border border-0 dropBTN rounded-5 bg-light pt-1 pb-2" id="filterData">
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <option value="All" @if(request('filterData')=='All' ) selected @endif>All</option>
                            </li>
                            <li>
                                <option value="Under-Review" @if(request('filterData')=='Under-Review' ) selected @endif>Under Review</option>
                            </li>
                            <li>
                                <option value="Approve" @if(request('filterData')=='Approve' ) selected @endif>Approve</option>
                            </li>
                            <li>
                                <option value="Reject" @if(request('filterData')=='Reject' ) selected @endif>Reject</option>
                            </li>
                            <li>
                                <option value="Asc" @if(request('filterData')=='Asc' ) selected @endif>Asc</option>
                            </li>
                            <li>
                                <option value="Desc" @if(request('filterData')=='Desc' ) selected @endif>Desc</option>
                            </li>
                        </ul>
                    </select>

                    <!-- </ul> -->
                    <button class="btn btn-primary rounded-5 bg-light text-dark border-0" type="submit">Filter</button>
                </div>



            </form>

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
            @if($reports->count() > 0)

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
                        <a href="{{route('user.viewReport', ['id' => $report->id])}}"><i class="fas fa-eye text-dark"></i></a>
                        <a href="{{ route('user.updateReport', ['id' => $report->id]) }}" onclick="checkStatus('{{ $report->report_status }}')">
                            <i class="fas fa-pen-to-square text-dark"></i>
                        </a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="far fa-circle-xmark text-danger"></i>
                        </a>

                    </div>
                </td>
            </tr>

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
                            <a href="{{route('user.deleteReport', ['id' => $report->id])}}"><button type="button" class="btn btn-danger" onclick="checkStatus('{{ $report->report_status }}')">Delete</button></a>
                        </div>
                    </div>
                </div>
            </div>


            @endforeach

            @else
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p class="mt-3">No results found.</p>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endif


        </tbody>
    </table>


    <div class="mt-3">
        {{ $reports->links(
                    'pagination::bootstrap-5'
                ) }}
    </div>


</div>

<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($revenues->pluck('report_month')->map(fn($date) => $date->format('M'))->toArray()), // Format month names
            datasets: [{
                label: 'Monthly Revenue',
                data: @json($revenues->pluck('report_monthly_revenue')->toArray()),
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>






<script>
    function checkStatus(status) {
        if (status !== 'Under Review') {
            alert('You cannot perform this action because the status is not "Under Review".');
            // Prevent the default link behavior (navigation) if the status is not "Under Review"
            event.preventDefault();
        }
    }
</script>

@endsection