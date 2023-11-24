@extends('layouts.userNav')
@section('main-content')
<div class="container2" style="background-color: white;border-radius: 30px;margin-left: 100px;margin-right: 100px;">
    <form action="{{ route('user.update', [auth()->user()->id]) }}" method="post">
        @method('PUT')
        @csrf
        <div class="row mt-4 profile-header">
            <h4 class="font-weight-bold mx-auto mt-2 profile-title">User Profile</h4>
        </div>
        <div class="table-responsive">
            <table class="table mt-3 profile-table">
                <tr>
                    <th class="col-md-4" style=" width: 200px;">IC Number</th>
                    <td>{{ Auth::guard('web')->user()->ic }}</td>
                </tr>
                <tr>
                    <th class="profile-label">Name</th>
                    <td>
                        <input class="form-control profile-input" type="text" name="name" id="name"
                            value="{{ strtoupper(Auth::guard('web')->user()->name) }}" readonly>
                    </td>
                </tr>
                <tr>
                    <th class="profile-label">Spouse Name</th>
                    <td>
                        <input class="form-control profile-input" type="text" name="sname" id="sname"
                            value="siti" readonly>
                    </td>
                </tr>
            </table>
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('user.card.uploadPayment')}}'">Proceed to payment</button>
        </div>
        <br>
        <br>
    </form>
</div>
@endsection