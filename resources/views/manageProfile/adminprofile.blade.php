@extends('layouts.adminNav')

@section('main-content')
    <!--ADMIN PROFILE -->
    <h1 style="border-radius: 30px;margin-left: 667px;margin-right: 708px;"> REGISTER STAFF</h1>
    <div class="container2" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">



        <!-- Display success message -->
        @if(session('success'))
            <div id="success-alert" class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Route to admin.store-staff to create new staff -->
        <form method="POST" action="{{ route('admin.store-staff') }}" style=" margin-left: 77px; padding-top: 51px ">
            @csrf
            <div class="row mb-3">
                <label for="ic" class="col-md-4 col-form-label text-md-end">{{ __('IC Number') }}</label>

                <div class="col-md-6">
                    <input id="ic" type="text" class="form-control @error('ic') is-invalid @enderror"
                        name="ic" value="{{ old('ic') }}" required autocomplete="ic" autofocus>

                    @error('ic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>



            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>


                <div class="col-md-6">


                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">


                <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>


                <div class="col-md-6">
                    <select id="gender" class="form-select @error('gender') is-invalid @enderror form-control"
                        name="gender" required autocomplete="gender" autofocus>
                        <option value="" hidden selected></option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    </select>



                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>

                <div class="col-md-6">
                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror"
                        name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>

                    @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-0" style=" margin-left: 430px; padding-top: 20px; padding-bottom: 43px;">
                <div class="col-md-6 offset-md-4">

                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Hide success message after 5 seconds
        $(document).ready(function() {
            setTimeout(function() {
                $("#success-alert").fadeOut("slow");
            }, 5000); // 5 seconds
        });
    </script>
@endsection
