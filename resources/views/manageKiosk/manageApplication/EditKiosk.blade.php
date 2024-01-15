@extends('layouts.userNav')

@section('main-content')
    <div class="container2" style="background-color: white; border-radius: 30px; margin-left: 100px; margin-right: 100px;">

        <!-- Route to user.update based on the user id to update the user profile-->
        <form action="{{ route('user.updateKiosk', ['id' => $application->application_id]) }}" method="POST">



            <!-- Cross Site Request Forgery Protection -->
            @csrf
            <!-- Override form method to PUT -->
            @method('PUT')

            <div class="row mt-4 profile-header">
                <h4 class="font-weight-bold mx-auto mt-2 profile-title text-center">Edit Kiosk Information</h4>
            </div>
            <div class="table-responsive">
                <table class="table mt-3 profile-table">
                    <tr>
                        <th class="col-md-4" style="width: 200px;">Kiosk ID</th>
                        <td> {{ $application->application_id }}</td>
                    </tr>
                    <tr>
                        <th class="profile-label">Business Name</th>
                        <td>
                            <input class="form-control profile-input" type="text" name="business_name" id="business_name"
                                value="{{ old('business_name', $application->business_name) }}">
                        </td>
                    </tr>
                    <tr>
                        <th class="profile-label">Business Role</th>
                        <td>
                            <select class="form-control profile-input" name="business_role" id="business_role">
                                <option value="VENDOR"
                                    {{ old('business_role', $application->business_role) === 'VENDOR' ? 'selected' : '' }}>
                                    Vendor</option>
                                <option value="FK STUDENTS"
                                    {{ old('business_role', $application->business_role) === 'FK STUDENTS' ? 'selected' : '' }}>
                                    FK Students</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="profile-label">Business Category</th>
                        <td>
                            <select class="form-control profile-input" name="business_category" id="business_category">
                                <option value="Food & Beverages"
                                    {{ old('business_category', $application->business_category) === 'Food & Beverages' ? 'selected' : '' }}>
                                    Food & Beverages</option>
                                <option value="Apparel & Accessories"
                                    {{ old('business_category', $application->business_category) === 'Apparel & Accessories' ? 'selected' : '' }}>
                                    Apparel & Accessories</option>
                                    <option value="Health & Beauty"
                                    {{ old('business_category', $application->business_category) === 'Health & Beauty' ? 'selected' : '' }}>
                                    Health & Beauty</option>
                                    <option value="Sports & Lifestyle"
                                    {{ old('business_category', $application->business_category) === 'Sports & Lifestyle' ? 'selected' : '' }}>
                                    Sports & Lifestyle</option>
                                    <option value="Home & Living"
                                    {{ old('business_category', $application->business_category) === 'Home & Living' ? 'selected' : '' }}>
                                    Home & Living</option>
                                    <option value="Electronics & Accessories"
                                    {{ old('business_category', $application->business_category) === 'Electronics & Accessories' ? 'selected' : '' }}>
                                    Electronics & Accessories</option>
                                    <option value="Books & Stationery"
                                    {{ old('business_category', $application->business_category) === 'Books & Stationery' ? 'selected' : '' }}>
                                    Books & Stationery</option>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="profile-label">Business Information</th>
                        <td>
                            <input class="form-control profile-input" type="text" name="business_information"
                                id="business_information"
                                value="{{ old('business_information', $application->business_information) }}">
                        </td>
                    </tr>
                    <tr>
                        <th class="profile-label">Business Operating Hour</th>
                        <td>
                            <input class="form-control profile-input" type="text" name="business_operating_hour"
                                id="business_operating_hour"
                                value="{{ old('business_operating_hour', $application->business_operating_hour) }}">
                        </td>
                    </tr>
                    <!-- Add more fields as needed -->
                </table>
            </div>
            <div class="text-center">
                <input class="btn profile-btn" type="submit"
                    onclick="return confirm('Confirm to update business information?')" value="Update">
            </div>
            <br>
            <br>
        </form>
    </div>
@endsection
