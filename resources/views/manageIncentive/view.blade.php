@extends('layouts.staffNav')

@section('main-content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Incentive</h6>
            </div>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Job</th>
                        <th>Job Type</th>
                        <th>Salary</th>
                        <th> Date</th>
                        <th> Status</th>
                        <th> Heir</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_incentive as $incentives)
                    <tr>
                        <td>{{$incentives->id}}</td>
                        <td>{{$incentives->applicant_name}}</td>
                        <td>{{$incentives->job}}</td>
                        <td>{{$incentives->job_type}}</td>
                        <td>{{$incentives->salary}}</td>
                        <td>{{$incentives->date}}</td>
                        <td>{{$incentives->status}}</td>
                        <td>{{$incentives->heir}}</td>
                        <td>         
                            <a href="{{route('staff.incentive.delete',['id' => $incentives->id])}}" class="btn btn-danger" title="Delete" onclick="return confirm('Confirm to delete?')">DELETE</a>
						</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>

        </div>
    </div>

@endsection
