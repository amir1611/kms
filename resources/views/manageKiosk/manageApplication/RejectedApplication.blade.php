@extends('layouts.userNav')

@section('main-content')
    <div class="container">
        <h2 class="mt-4 text-danger">Your Application has been rejected!</h2>




        @if (!empty($application->application_comment))
            <div class="col-md-6">
                <div class="card" style="margin-top: 20px; height: 137px;">
                    <div class="card-body">

                        <p><strong>Application ID:</strong> {{ $application->application_id }}</p>
                        <p><strong>Rejection Reason: </strong>{{ $application->application_comment }}</p>
                    </div>
                </div>
            </div>
        @endif

        <p style=" margin-left: 14px; margin-top: 20px;">Make a new Kiosk Application <a
                href="{{ route('user.rejectApplication') }}"><b>here</b></a>.</p>

    </div>




    <br>
@endsection
