@extends('layouts.userNav')

{{-- KP to edit complaint --}}

@section('main-content')
    <div class="container2">
        <form action="{{ route('user.updateComplaint', ['id' => $complaint->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mt-4 profile-header">
                <h4 class="font-weight-bold mx-auto mt-2 profile-title">Edit Complaint Information</h4>
            </div>
            <div class="table-responsive">
                <table class="table mt-3 profile-table">
                    <tr>
                        <th class="col-md-4" style="width: 200px;">Complaint ID</th>
                        <td>{{ $complaint->id }}</td>
                    </tr>
                    <tr>
                        <th class="profile-label">Business Name</th>
                        <td>
                            <input class="form-control profile-input" type="text" name="business_name" id="business_name"
                                value="{{ old('business_name', $complaint->business_name) }}">
                        </td>
                    </tr>

                    <tr>
                        <th class="profile-label">Complaint Category</th>
                        <td>
                            <select class="form-control profile-input" name="complaint_category" id="complaint_category">
                                <option value="Services"
                                    {{ old('complaint_category', $complaint->complaint_category) === 'Services' ? 'selected' : '' }}>
                                    Services</option>
                                <option value="Tools"
                                    {{ old('complaint_category', $complaint->complaint_category) === 'Tools' ? 'selected' : '' }}>
                                    Tools</option>
                                <option value="Fees"
                                    {{ old('complaint_category', $complaint->complaint_category) === 'Fees' ? 'selected' : '' }}>
                                    Fees</option>
                                <option value="Others"
                                    {{ old('complaint_category', $complaint->complaint_category) === 'Others' ? 'selected' : '' }}>
                                    Others</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Complaint Details</th>
                        <td>
                            <input class="form-control profile-input" type="text" name="complaint_information"
                                id="complaint_information"
                                value="{{ old('complaint_information', $complaint->complaint_information) }}">
                        </td>
                    </tr>
                    <!-- Add more fields as needed -->
                </table>
            </div>
            <div class="text-center">
                <input type="submit" class="btn profile-btn" value="Edit Complaint"
                    onclick="return confirm('Confirm to update complaint information?')">
            </div>
            <br>
            <br>
        </form>
    </div>
@endsection
