@extends('layouts.fkTechnicalNav')

@section('main-content')
    <div class="container">
        <h4 class="font-weight-bold mt-4 mb-4">View Complaints</h4>
        {{-- <!-- Add Complaint button -->
        <a href="{{ route('user.addComplaint')}}" class="btn btn-primary">Add Complaint</a> --}}

        @if ($complaints->isEmpty())
            <p>No complaints found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Submitted Date</th>
                        <th>Business Name</th>
                        <th>Complaint Category</th>
                        <th>Complaint Information</th>
                        <th>Status</th> <!-- New column for status -->
                        <th>Justification</th> <!-- New column for justification -->
                        <th>Work Order</th> <!-- New column for work order -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->date_of_filling_form }}</td>
                            <td>{{ $complaint->business_name }}</td>
                            <td>{{ $complaint->complaint_category }}</td>
                            <td>{{ $complaint->complaint_information }}</td>
                            <td>{{ $complaint->status }}</td>
                            <td>{{ $complaint->complaint_justification }}</td>
                            <td>{{ $complaint->work_order }}</td>
                            {{-- <td> <div class="w-100">
                                <input type="text" class="form-control" id="complaint_justification" name="complaint_justification" placeholder="Enter justification" required>
                            </div></td>


                            <td>
                                {{ $complaint->status }}
                                <div class="dropdown mr-4 dropBTN" id="myDropdown">
                                    <button class="btn bg-light dropdown-toggle dropBTN" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false" onclick="toggleDropdown()">
                                        Sort by: <b>Status</b>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{{ route('technical.viewAllComplaint', ['sort' => 'All']) }}">All</a></li>
                                        <!-- Add more items as needed -->
                                    </ul>
                                </div>

                            </td>

                            <td><div class="w-100">
                                <input type="text" class="form-control" id="work_order" name="work_order" placeholder="Enter work to take" required>
                            </div></td> --}}
                            </div>
                        </div>
                            </td>
                            <td>
                                <a href="{{ route('technical.editComplaint', ['id' => $complaint->id]) }}" class="btn btn-info">update</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif
    </div>

    <style>
        /* Add your custom styles here */

.btn-primary {
    background-color: #007BFF;
    color: white;
}

.btn-info {
    background-color: #17a2b8;
    color: white;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn {
    margin-right: 5px;
}

.container {
    margin-top: 20px;
}

table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #17a2b8;
    color: #f5f5f5;
}

tr:hover {
    background-color: #f5f5f5;
}

/* Additional styles for textarea */
textarea {
    width: 100%;
    margin-top: 10px;
    resize: none; /* Prevent textarea resizing */
}
</style>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("myDropdown");
        dropdown.classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropBTN')) {
            var dropdowns = document.getElementsByClassName("dropdown");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

@endsection
