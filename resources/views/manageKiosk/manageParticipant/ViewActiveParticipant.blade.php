@extends('layouts.pupukAdminNav')

@section('main-content')
    <div class="container">
        <h2 class="mt-4">Participant Information</h2>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Profile</h4>
                        <p><strong>IC:</strong> {{ $user->ic }}</p>
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Gender:</strong> {{ $user->gender }}</p>
                        <p><strong>Contact:</strong> {{ $user->contact }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Business Info</h4>
                        <p><strong>Application ID:</strong> {{ $application->application_id }}</p>
                        <p><strong>Business Name:</strong> {{ $application->business_name }}</p>
                        <p><strong>Business Role:</strong> {{ $application->business_role }}</p>
                        <p><strong>Business Category:</strong> {{ $application->business_category }}</p>
                        <p><strong>Business Information:</strong> {{ $application->business_information }}</p>
                        <p><strong>Business Operating Hour:</strong> {{ $application->business_operating_hour }}</p>
                        <p><strong>Business Start Date:</strong> {{ $application->business_start_date }}</p>

                        <p>
                            <strong>SSM PDF:</strong>
                            <a href="{{ asset('storage/applications/' . basename($application->ssm_pdf)) }}"
                                target="_blank">
                                <p>{{ basename($application->ssm_pdf) }}</p>
                            </a>
                        </p>


                        <p>
                            <strong>Business Proposal PDF:</strong>
                            <a href="{{ asset('storage/applications/' . basename($application->business_proposal_pdf)) }}"
                                target="_blank">
                                <p> {{ basename($application->business_proposal_pdf) }}</p>
                            </a>
                        </p>


                    </div>
                </div>
            </div>

            @if (!empty($application->application_comment))
                <div class="col-md-6">
                    <div class="card" style="margin-top: -139px; height: 137px;">
                        <div class="card-body">
                            <h4 class="card-title">Application Comment</h4>
                            <p>{{ $application->application_comment }}</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>


    </div>

    <br>
@endsection
