@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="padding-top: -70px;">
                        <img src="assets/banner.png" style="margin-left: 76px;" draggable="false" alt="">
                    </div>
                    <div class="card-body">

                        <!--Route to Login-->
                        <form method="POST" action="{{ route('login') }}">

                            @csrf
                            <div class="row mb-3">

                                <!-- Display error message if the user ic number is already registered-->
                                @if (session('error'))
                                    <span class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('error') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </span>
                                @endif

                                <!-- Display error message if the user ic number is already registered-->
                                <label for="ic"
                                    class="col-md-4 col-form-label text-md-end">{{ __('IC Number') }}</label>
                                <div class="col-md-6">
                                    <input id="ic" type="text"
                                        class="form-control @error('ic') is-invalid @enderror" name="ic"
                                        value="{{ old('ic') }}" required autocomplete="ic" autofocus>

                                        
                                    @error('ic')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">

                                <!-- Password -->
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">

                                        <!-- Remember Me -->
                                        <input class="form-check-input" style=" margin-top: 10px; " type="checkbox"
                                            name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>

                                        <!--Route to password.request-->
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link ml-5" href="{{ route('password.request') }}"
                                                style="  margin-right: 0; padding-left: 114px; ">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-0" style=" margin-top: 19px;">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style=" width: 400px;">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>

                            <hr style="margin-top: 29px; margin-right: 142px; margin-left: 282px;">

                            <div class="row mb-0" style=" margin-top: 19px;">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn"
                                        style="width: 400px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #0b5ed7;"
                                        onmouseover="this.style.backgroundColor='#0d6efd'; this.style.color='#ffffff';"
                                        onmouseout="this.style.backgroundColor=''; this.style.color='';">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </button>
                                </div>
                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
