@extends('layouts.userNav')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Details') }}</h1>

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

    <div class="row">

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="applicant" role="tabpanel" aria-labelledby="applicant_tab">
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="name">Name<span
                                        class="small text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="applicant_name"
                                    placeholder="Name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="birthdate">Date of Birth</label>
                                <input type="date" id="birthdate" class="form-control" name="applicant_birthdate"
                                    placeholder="Date of birth">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="applicant_email">Age<span
                                        class="small text-danger">*</span></label>
                                <input type="email" id="applicant_age" class="form-control" name="applicant_age"
                                    placeholder="Age">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="applicant_houseaddress">House Address<span
                                        class="small text-danger">*</span></label>
                                <input type="text" id="applicant_houseaddress" class="form-control" name="applicant_houseaddress"
                                    placeholder="House Address">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="applicant_nationality">Nationality</label>
                                <input type="text" id="applicant_nationality" class="form-control"
                                    name="applicant_nationality" placeholder="Nationality">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="document">Payment Proof<span
                                        class="small text-danger">*</span></label>
                                <input type="file" id="docs" class="form-control"
                                    name="docs" placeholder="docs"required>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
            </form>

        </div>

    </div>

    </div>

    </div>

@endsection
