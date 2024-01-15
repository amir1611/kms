@extends('layouts.fkTechnicalNav')

{{-- fk tech to update their feedbacks on complaint --}}

@section('main-content')
    <div class="container2">
        <form action="{{ route('technical.updateComplaint', ['id' => $complaint->id]) }}" method="POST">
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
                                value="{{ $complaint->business_name }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th class="profile-label">Complaint Category</th>
                        <td>
                            <input class="form-control profile-input" type="text" name="complaint_category"
                                id="complaint_category" value="{{ $complaint->complaint_category }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>Complaint Details</th>
                        <td>
                            <input class="form-control profile-input" type="text" name="complaint_information"
                                id="complaint_information" value="{{ $complaint->complaint_information }}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <select class="form-control profile-input" name="status" id="status">
                                <option value="Accepted" {{ $complaint->status == 'Accepted' ? 'selected' : '' }}>Accepted
                                </option>
                                <option value="Rejected" {{ $complaint->status == 'Rejected' ? 'selected' : '' }}>Rejected
                                </option>
                                <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                            </select>
                        </td>
                    </tr>

                    <!-- Additional fields -->
                    <tr>
                        <th>Complaint Justification</th>
                        <td>
                            <input class="form-control profile-input" type="text" name="complaint_justification"
                                id="complaint_justification"
                                value="{{ old('complaint_justification', $complaint->complaint_justification) }}">
                        </td>
                    </tr>

                    <tr>
                        <th>Work Order</th>
                        <td>
                            <input class="form-control profile-input" type="text" name="work_order" id="work_order"
                                value="{{ old('work_order', $complaint->work_order) }}">
                        </td>
                    </tr>
                    <!-- Add more fields as needed -->
                </table>
            </div>
            <div class="text-center">
                <input type="submit" class="btn profile-btn" value="Submit"
                    onclick="return confirm('Confirm to update complaint information?')">
            </div>
            <br>
            <br>
        </form>
    </div>
@endsection
