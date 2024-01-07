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

@php
use Illuminate\Support\Str;
@endphp


<div class="container2 p-5" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">

    <div class="row  profile-header">
        <h4 class="font-weight-bold mx-auto  profile-title">Monthly Report List</h4>
    </div>

    <canvas id="revenueChart" width="400" height="200"></canvas>
</div>


<div class="container2 p-5" style="background-color: white;border-radius: 30px;margin-top: 20px;margin-bottom: 20px;margin-left: 100px;margin-right: 100px;">

    <div class="d-flex justify-content-between align-items-center">
        <h4><b>All Monthly Report</b></h4>

        <div class="d-flex">
            <form class="d-flex input-group w-auto mr-4" action="{{ route('pupuk.searchReport') }}" method="GET">

                <span class="input-group-text searchLogo bg-light" id="search-addon">
                    <button type="submit" class="border-0 bg-light"><i class="fas fa-search"></i></button>
                </span>

                <input type="search" class="form-control searchField bg-light" name="searchTerm" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />

            </form>
            <form action="{{ route('pupuk.filterSec', ['filterData' => 'Month']) }}" method="GET">
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
                                <option value="Asc" @if(request('filterData')=='Asc' ) selected @endif>Old to new</option>
                            </li>
                            <li>
                                <option value="Desc" @if(request('filterData')=='Desc') selected @endif>New to old</option>
                            </li>
                        </ul>
                    </select>

                    <!-- </ul> -->
                    <button class="btn btn-primary rounded-5 bg-light text-dark border-0" type="submit">Filter</button>
                </div>



            </form>

           
        </div>


    </div>

    <table class="table align-middle mb-0 bg-white">
        <thead class="">
            <tr>
                <th>Name</th>
                <th>Kiosk ID</th>
                <th>Month</th>
                <th>Sale Revenue (RM)</th>
                <th>Report</th>
                <th>Remark</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if($reports->count() > 0)

            @foreach($reports as $report)
            <tr>
                <td>
                    <a href="{{route('pupuk.updateReport', ['id' => $report->id])}}">{{$report->name}}</a>
                </td>
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
            </tr>


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
    // Get the revenue data from the controller
    var revenuesByKiosk = {!! json_encode($revenues) !!};

    // Extract kiosk IDs and revenue values
    var kioskIDs = Object.keys(revenuesByKiosk);
    var revenueValues = Object.values(revenuesByKiosk);

    console.log(revenueValues);

    // Chart configuration
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: kioskIDs,
            datasets: [{
                label: 'Monthly Revenue',
                data: revenueValues,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2, // Set the line width
                pointRadius: 5, // Set the point radius
                fill: true,
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1, // Set the step size for the x-axis
                    },
                    title: {
                        display: true,
                        text: 'Kiosk ID'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Monthly Revenue'
                    }
                }
            }
        }
    });
</script>

@endsection