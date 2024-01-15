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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@extends('layouts.pupukAdminNav')

@section('main-content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="row mt-4 profile-header">
        <h4 class="font-weight-bold mx-auto mt-2 profile-title">Manage Kiosk Participant</h4>
    </div>

    <div class="container2 p-1" style="background-color: white;border-radius: 30px;margin: 20px 100px;">

        <div class="d-flex justify-content-between align-items-center mt-3">
            <h4 style="margin-left: 20px; margin-bottom:20px"><b>All Kiosk Participants</b></h4>

           
        </div>

        <table class="table align-middle mb-0 bg-white text-center">
            <thead>
                <tr>
                    <th>Kiosk ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Business Name</th>
                    <th>Email</th>
                    <th>IC Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kioskApplications as $application)
                    <tr>
                        <td>{{ $application->kiosk_id }}</td>
                        <td>{{ $application->name }}</td>
                        <td>{{ $application->business_role }}</td>
                        <td>{{ $application->business_name }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->ic }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('pupuk.viewApplication', ['id' => $application->application_id]) }}">
                                    <i class="fas fa-eye text-dark"></i>
                                </a>
                                <a href="{{ route('pupuk.updateApplicationStatus', ['id' => $application->application_id]) }}">
                                    <i class="fas fa-trash text-danger" style="margin-left: 20px"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-5">
            <p style="color: rgb(182, 182, 182);">Showing data {{ $kioskApplications->firstItem() }} to
                {{ $kioskApplications->lastItem() }} of {{ $kioskApplications->total() }} entries</p>
            {{ $kioskApplications->links() }}
        </div>
    </div>
@endsection
