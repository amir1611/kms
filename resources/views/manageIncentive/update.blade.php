@extends('layouts.userNav')

@section('main-content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">INCENTIVE RESULTS</h6>
            </div>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th> Date</th>
                        <th> Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_incentive as $incentives)
                    <tr>
                        <td>{{$incentives->id}}</td>
                        <td>{{$incentives->applicant_name}}</td>
                        <td>{{$incentives->date}}</td>
                        <td>{{$incentives->status}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>

        </div>
    </div>

@endsection
