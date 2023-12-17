@extends('layouts.pupukAdminNav')

@section('main-content')
    <div class="container">
        <h2>Kiosk Approval</h2>

        <div class="row mt-4">
            <div class="col-md-6">
                <h4>User Profile</h4>
                <p><strong>IC:</strong> {{ $user->ic }}</p>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Gender:</strong> {{ $user->gender }}</p>
                <p><strong>Contact:</strong> {{ $user->contact }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
            <div class="col-md-6">
                <h4>Business Info</h4>
                <p><strong>Application ID:</strong> {{ $application->application_id }}</p>
                <p><strong>Business Name:</strong> {{ $application->business_name }}</p>
                <p><strong>Business Role:</strong> {{ $application->business_role }}</p>
                <p><strong>Business Category:</strong> {{ $application->business_category }}</p>
                <p><strong>Business Information:</strong> {{ $application->business_information }}</p>
                <p><strong>Business Operating Hour:</strong> {{ $application->business_operating_hour }}</p>
                <p><strong>Business Start Date:</strong> {{ $application->business_start_date }}</p>
                <p><strong>SSM PDF:</strong> {{ $application->ssm_pdf }}</p>
                <p><strong>Business Proposal PDF:</strong> {{ $application->business_proposal_pdf }}</p>
            </div>
        </div>

        <form method="post" action="{{ route('pupuk.processApplication', ['id' => $application->application_id]) }}">
            @csrf
            <label for="application_comment">Add Comments:</label>
            <textarea name="application_comment" id="application_comment"></textarea>

            <button type="submit" name="action" value="approve">Approve</button>
            <button type="submit" name="action" value="reject">Reject</button>
        </form>
    </div>
@endsection
