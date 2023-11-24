@extends('layouts.staffNav')

@section('content')
<head>
    <style>
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
    
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }
    
        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
    
        .font-weight-bold {
            font-weight: bold;
        }
    
        .text-primary {
            color: #007bff;
        }
    
        .card-body {
            flex: 1 1 auto;
            padding: 1.25rem;
        }
    
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
    
        .col-md-6 {
            flex: 0 0 auto;
            width: 50%;
            max-width: 50%;
            padding-right: 15px;
            padding-left: 15px;
        }
    
        .d-flex {
            display: flex !important;
        }
    
        .justify-content-end {
            justify-content: flex-end !important;
        }
    
        .align-items-center {
            align-items: center !important;
        }
    
        .me-4 {
            margin-right: 1.5rem !important;
        }
    
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
    
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
    
        .table-bordered {
            border: 1px solid #dee2e6;
        }
    
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }
    
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
    
        th {
            font-weight: bold;
            text-align: left;
        }
    
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
    
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
    
        td {
            padding: 0.75rem;
            vertical-align: top;
            border-top:
        }
            .btn-group {
        position: relative;
        display: inline-flex;
        vertical-align: middle;
    }

    .btn-info {
        color: #fff;
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-success {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .card-footer {
        padding: 0.75rem 1.25rem;
        background-color: #fff;
        border-top: 1px solid rgba(0, 0, 0, 0.125);
    }

    .text-center {
        text-align: center !important;
    }

    .d-flex.justify-content-center {
        justify-content: center !important;
    }

    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
    }

    .pagination .page-item:first-child .page-link {
        margin-left: 0;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .pagination .page-item:last-child .page-link {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }

    .pagination .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .pagination .page-link {
        position: relative;
        display: block;
        color: #007bff;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
</style>

    
</head>
{{-- <link rel="stylesheet" href="{{ asset('css/bootstrapciplak.css') }}"> --}}
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Consultation</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <div class="d-flex align-items-center me-4">
                            <a href="{{ route('staff.consultant.create') }}" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Location</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!$datas->isEmpty())
                    @php $counter = 0; @endphp
                    @foreach ($datas as $data)
                        @php $counter++; @endphp
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data['department']['value'] }}</td>
                            <td>{{ $data['location']['value'] }}</td>
                            <td>{{ $data->phoneNo }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">There is no property available.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $datas->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
