@extends('layouts.pupukAdminNav')

@section('main-content')
    <div class="container">
        <h2 class="mt-4">Kiosk Approval</h2>

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
                                {{ basename($application->ssm_pdf) }}
                            </a>
                        </p>


                        <p>
                            <strong>Business Proposal PDF:</strong>
                            <a href="{{ asset('storage/applications/' . basename($application->business_proposal_pdf)) }}"
                                target="_blank">
                                {{ basename($application->business_proposal_pdf) }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Comments(Optional)</h4>
                        <form method="post"
                            action="{{ route('pupuk.processApplication', ['id' => $application->application_id]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="application_comment" class="form-label">Comments:</label>
                                <textarea class="form-control" name="application_comment" id="application_comment" rows="3"></textarea>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="submit" class="btn btn-success" name="action"
                                    value="approve">Approve</button>
                                <button type="submit"class="btn btn-danger" style="margin-left: 20px" name="action"
                                    value="reject">Reject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
@endsection
