@extends('layouts.userNav')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

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

                <form method="POST" action="{{ route('user.register.uploadPayment') }}" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="_method" value="PUT">
                    {{-- <div class="card-header py-2"> --}}
                    <label for="example-color-input" class="form-control-label mb-3">Marriage's Detail</label>
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#applicant"
                                    role="tab" aria-controls="profile" aria-selected="true">
                                    Applicant's Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#spouse" role="tab"
                                    aria-controls="dashboard" aria-selected="false">
                                    Spouse's Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#marriage" role="tab"
                                    aria-controls="dashboard" aria-selected="false">
                                    Marriage Information
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
                                                <input type="text" id="name" class="form-control"
                                                    name="applicant_name" placeholder="Name" value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="birthdate">Date of Birth</label>
                                                <input type="date" id="birthdate" class="form-control"
                                                    name="applicant_birthdate" placeholder="date of birth">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="applicant_email">Email address<span
                                                        class="small text-danger">*</span></label>
                                                <input type="email" id="applicant_email" class="form-control"
                                                    name="applicant_email"
                                                    placeholder="example@example.com"value="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="applicant_IcNum">IC Number<span
                                                        class="small text-danger">*</span></label>
                                                <input type="text" id="applicant_IcNum" class="form-control"
                                                    name="applicant_IcNum" placeholder="IC Number"
                                                    value="{{ $user->ic }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="applicant_gender">Gender</label>
                                                <input type="text" id="applicant_gender" class="form-control"
                                                    name="applicant_gender"
                                                    placeholder="gender"value="{{ $user->gender }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="applicant_phoneNo">Phone
                                                    Number</label>
                                                <input type="text" id="phoneNo" class="form-control"
                                                    name="applicant_phoneNo" placeholder="phone number"
                                                    value="{{ $user->contact }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label"
                                                    for="applicant_nationality">Nationality</label>
                                                <input type="text" id="applicant_nationality" class="form-control"
                                                    name="applicant_nationality" placeholder="Nationality">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="spouse" role="tabpanel" aria-labelledby="spouse_tab">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="spouse_name">Name<span
                                                        class="small text-danger">*</span></label>
                                                <input type="text" id="spouse_name" class="form-control"
                                                    name="spouse_name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="spouse_birthdate">Date of
                                                    Birth</label>
                                                <input type="date" id="spouse_birhtdate" class="form-control"
                                                    name="spouse_birthdate" placeholder="date of birth">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="spouse_email">Email address<span
                                                        class="small text-danger">*</span></label>
                                                <input type="email" id="spouse_email" class="form-control"
                                                    name="spouse_email" placeholder="example@example.com">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="spouse_IcNum">IC Number<span
                                                        class="small text-danger">*</span></label>
                                                <input type="text" id="spouse_IcNum" class="form-control"
                                                    name="spouse_IcNum" placeholder="IC Number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="spouse_gender">Gender</label>
                                                <input type="text" id="spouse_gender" class="form-control"
                                                    name="spouse_gender" placeholder="gender">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="spouse_phoneNo">Phone
                                                    Number</label>
                                                <input type="text" id="spouse_phoneNo" class="form-control"
                                                    name="spouse_phoneNo" placeholder="phone number">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label"
                                                    for="spouse_nationality">Nationality</label>
                                                <input type="text" id="spouse_nationality" class="form-control"
                                                    name="spouse_nationality" placeholder="Nationality">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="marriage" role="tabpanel" aria-labelledby="marriage_tab">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="wali_name">Wali Name<span
                                                        class="small text-danger">*</span></label>
                                                <input type="text" id="wali_name" class="form-control"
                                                    name="wali_name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="wali_number">Wali HP Number</label>
                                                <input type="text" id="wali_number" class="form-control"
                                                    name="wali_number" placeholder="HP Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="wali_address">Wali Address</label>
                                                <input type="text" id="wali_address" class="form-control"
                                                    name="wali_address" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="wali_relationship">Wali Relationship</label>
                                                <input type="text" id="wali_relationship" class="form-control"
                                                    name="wali_relationship" placeholder="Relationship">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="witness_name">Witness Name<span
                                                        class="small text-danger">*</span></label>
                                                <input type="text" id="witness_name" class="form-control"
                                                    name="witness_name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="witness_number">Witness HP Number</label>
                                                <input type="text" id="witness_number" class="form-control"
                                                    name="witness_number" placeholder="HP Number">
                                            </div>
                                        </div>
                                        
                                        
                                    </div>

                                    

                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary">Proceed to payment</button>
                            </div>
                        </div>
                    </div>
                </form>

                

            </div>

        </div>

    </div>

@endsection