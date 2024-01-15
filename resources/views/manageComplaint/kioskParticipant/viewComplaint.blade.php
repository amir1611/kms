@extends('layouts.userNav')


{{-- KP to view Complaint --}}

@section('main-content')
    <div class="container">
        <h4 class="font-weight-bold mt-4 mb-4">View Complaints</h4>
        <!-- Add Complaint button -->
        <a href="{{ route('user.addComplaint')}}" class="btn btn-primary">Add Complaint</a>

        @if ($complaints->isEmpty())
            <p>No complaints found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Business Name</th>
                        <th>Complaint Category</th>
                        <th>Complaint Information</th>
                        <th>Status</th>
                        <th>Complaint_justification</th>
                        <th>Work_order</th>
                        <th>Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->id }}</td>
                            <td>{{ $complaint->business_name }}</td>
                            <td>{{ $complaint->complaint_category }}</td>
                            <td>{{ $complaint->complaint_information }}</td>
                            <td>{{ $complaint->status }}</td>
                            <td>{{ $complaint->complaint_justification }}</td>
                            <td>{{ $complaint->work_order }}</td>
                            <td>
                                <a href="{{ route('user.editComplaint', ['id' => $complaint->id]) }}" class="btn btn-info">Edit</a>
                                <form action="{{ route('user.deleteComplaint', ['id' => $complaint->id]) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this complaint?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <style>
        /* Add your custom styles here */

        .btn-primary {
            background-color: #007BFF;
            color: white;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn {
            margin-right: 5px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: red;
            color: black;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
@endsection
