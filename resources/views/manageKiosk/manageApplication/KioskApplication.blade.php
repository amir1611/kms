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


@extends('layouts.pupukAdminNav')

@section('main-content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="container2" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">

        <div class="row mt-4 profile-header">
            <h4 class="font-weight-bold mx-auto mt-2 profile-title">Manage Kiosk Application</h4>
        </div>


    </div>

    <div class="container2 p-5"
        style="background-color: white;border-radius: 30px;margin-top: 20px;margin-bottom: 20px;margin-left: 100px;margin-right: 100px;">

        <div class="d-flex justify-content-between align-items-center">
            <h4><b>All Kiosk Applications</b></h4>

            <div class="d-flex">
                <form class="d-flex input-group w-auto mr-4">

                    <span class="input-group-text searchLogo bg-light" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>

                    <input type="search" class="form-control searchField bg-light" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" />

                </form>

                <div class="dropdown mr-4  dropBTN">
                    <button class="btn bg-light dropdown-toggle dropBTN" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by: <b>Status</b>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">New</a></li>
                        <li><a class="dropdown-item" href="#">Active</a></li>
                        <li><a class="dropdown-item" href="#">Inactive</a></li>
                        <li><a class="dropdown-item" href="#">Rejected</a></li>

                    </ul>
                </div>
            </div>


        </div>

        <table class="table align-middle mb-0 bg-white">
            <thead class="">
                <tr>
                    <th>Application ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Business Name</th>
                    <th>Email</th>
                    <th>IC Number</th>
                    <th>Status</th>
                    <th>Application</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($kioskApplications as $application)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ $application->application_id }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <p class="fw-normal mb-1">{{ $application->name }}</p>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $application->business_role }}</p>
                        </td>
                        <td>

                            <p class="fw-normal mb-1">{{ $application->business_name }}</p>

                        </td>
                        <td>

                            <p class="fw-normal mb-1">{{ $application->email }}</p>

                        </td>
                        <td>

                            <p class="fw-normal mb-1">{{ $application->ic }}</p>
                            <td>
                                @if ($application->application_status == 'Active')
                                    <p class="text-success">{{ $application->application_status }}</p>
                                @elseif ($application->application_status == 'Inactive')
                                    <p class="text-danger">{{ $application->application_status }}</p>
                                @elseif ($application->application_status == 'New')
                                    <p class="text-danger">{{ $application->application_status }}</p>
                                @elseif ($application->application_status == 'Rejected')
                                    <p class="text-warning">{{ $application->application_status }}</p>
                                @else
                                    <p class="text-warning">{{ $application->application_status }}</p>
                                @endif
                            </td>
                            
                        <td>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('pupuk.viewApplicationApproval', ['id' => $application->application_id]) }}">
                                    <i class="fas fa-eye text-dark"></i>
                                </a>
                                
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
