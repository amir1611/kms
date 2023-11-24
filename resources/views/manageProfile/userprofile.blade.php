@extends('layouts.userNav')


@section('main-content')
    <div class="container2" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">

        <!-- Route to user.update based on the user id to update the user profile-->
        <form action="{{ route('user.update', [auth()->user()->id]) }}" method="post">


            <!-- Override form method to PUT -->
            @method('PUT')

            <!-- Cross Site Request Forgery Protection -->
            @csrf


            <div class="row mt-4 profile-header">
                <h4 class="font-weight-bold mx-auto mt-2 profile-title">User Profile</h4>
            </div>
            <div class="table-responsive">
                <table class="table mt-3 profile-table">
                    <tr>
                        <th class="col-md-4" style=" width: 200px;">IC Number</th>

                        <!-- Display user ic number -->
                        <td>{{ Auth::guard('web')->user()->ic }}</td>
                    </tr>
                    <tr>
                        <th class="profile-label">Name</th>
                        <td>

                            <!-- Display user name -->
                            <input class="form-control profile-input" type="text" name="name" id="name"
                                value="{{ strtoupper(Auth::guard('web')->user()->name) }}">
                        </td>
                    </tr>
                    <tr>

                        <th class="profile-label">Gender</th>
                        <td>


                            <select class="form-control profile-input" name="gender" id="gender">
                                <option value="male"
                                    {{ Auth::guard('web')->user()->gender === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female"
                                    {{ Auth::guard('web')->user()->gender === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="profile-label">Phone Number</th>
                        <td>


                            <input class="form-control profile-input" type="text" name="contact" id="contact"
                                value="{{ Auth::guard('web')->user()->contact }}">
                        </td>
                    </tr>
                    <tr>
                        <th class="profile-label">Email</th>
                        <td>

                            <input class="form-control profile-input" type="email" name="email" id="email"
                                value="{{ Auth::guard('web')->user()->email }}">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="text-center">


                <input class="btn profile-btn" type="submit" onclick="return confirm('Confirm to update profile?')"
                    value="Edit Profile">
            </div>
            <br>
            <br>
        </form>
    </div>


    <div class="container2"
        style="background-color: white;border-radius: 30px;margin-top: -1px;margin-bottom: 20px;margin-left: 100px;margin-right: 100px;">


        <!-- Route to user.update-password-user based on the user id to change user password-->
        <form action="{{ route('user.update-password-user') }}" method="POST">


            <!-- Cross Site Request Forgery Protection -->
            @csrf

            <div class="row mt-4 profile-header">
                <h4 class="font-weight-bold mx-auto mt-2 profile-title">Change Password</h4>
            </div>
            <div class="table-responsive">
                <table class="table mt-3 profile-table">

                    <tr>
                        <th class="profile-label" style="width: 200px;">Old Password</th>
                        <td>
                            <input name="old_password" type="password"
                                class="form-control profile-input @error('old_password') is-invalid @enderror"
                                id="oldPasswordInput" placeholder="Old Password">
                        </td>
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </tr>

                    <tr>
                        <th class="profile-label" style="width: 200px;">New Password</th>
                        <td>
                            <input name="new_password" type="password"
                                class="form-control profile-input @error('new_password') is-invalid @enderror"
                                id="newPasswordInput" placeholder="New Password">
                        </td>
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </tr>

                    <tr>
                        <th class="profile-label" style="width: 200px;">Confirm New Password</th>
                        <td>
                            <input name="new_password_confirmation" type="password" class="form-control profile-input"
                                id="confirmNewPasswordInput" placeholder="Confirm New Password">
                        </td>
                    </tr>



                </table>
            </div>
            <div class="text-center">
                <input class="btn profile-btn" type="submit" onclick="return confirm('Confirm to change password?')"
                    value="Change Password">
            </div>
            <br>
            <br>
        </form>
    </div>
@endsection
