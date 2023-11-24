@extends('layouts.userNav')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Incentive') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-lg-12 order-lg-1">

        <div class="card shadow mb-4">

            <div class="card-header py-3">

                {{-- <div class="card-body"> --}}

                <form method="POST" action="{{ route('user.incentive.insert') }}" autocomplete="off" enctype="multipart/form-data">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
                   
                    {{-- <div class="card-header py-2"> --}}
                    <label for="example-color-input" class="form-control-label mb-3">Incentive Apllication Information</label>
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#spouse"
                                    role="tab" aria-controls="profile" aria-selected="true">
                                    Applicant's Information
                                </a>
                            </li>
                        </ul>
                        <br>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="applicant" role="tabpanel"
                                aria-labelledby="applicant_tab">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="name">Name<span
                                                        class="small text-danger">*</span></label>
                                                <input type="text" id="applicant_name" class="form-control"
                                                    name="applicant_name" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="job">Job<span
                                                        class="small text-danger">*</span></label>
                                                <input type="text" id="job" class="form-control" 
                                                name="job" placeholder="Job" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="job_type">Job Type</label>
                                                <select class="form-control" name="job_type" required>
                                                    <option value="" disabled selected>Select a Job Type</option>
                                                    <option value="full_time"> Full Time</option>
                                                    <option value="part_time"> Part Time</option>
                                                    <option value="contract"> Contract </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="salary">Salary<span
                                                        class="small text-danger">*</span></label>
                                                <input type="text" id="salary" class="form-control"
                                                    name="salary" placeholder="RM0.00" equired>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="date"> Date<span
                                                        class="small text-danger">*</span></label>
                                                <input type="date" id="date" class="form-control" name="date"
                                                    placeholder="date"required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="status">Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="" disabled selected>Select status</option>
                                                    <option value="Application"> Application</option>
                                                    <option value="Complete Application">Complete Application</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="ref_slot_id">heir</label>
                                                <select class="form-control" name="heir" required>
                                                    <option value="" disabled selected>Select a heir</option>
                                                    <option value="Family Member"> Family Member</option>
                                                    <option value="Friends"> Friends</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="document">Document<span
                                                        class="small text-danger">*</span></label>
                                                <input type="file" id="docs" class="form-control"
                                                    name="docs" placeholder="docs"required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button -->
                    <br><br>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                <form method="POST" action="{{ route('user.incentive.update') }}" autocomplete="off" enctype="multipart/form-data">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">CHECK STATUS</button>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- </div> --}}

            </div>

        </div>

    </div>

@endsection
