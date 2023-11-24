@extends('layouts.userNav')

@section('main-content')
    <div class="col-lg-12 order-lg-1">
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <div class="pl-lg-4">
                    <div class="row">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Marriage Preparation Course</h6>
                        <div class="col text-right">
                            <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('user.prepCourse.create')}}'">Add New</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Marriage Preparation Course</h6>
            </div>
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th><br></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Organizer
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Action
                        </th>
                    </tr>
                    @php $counter = 0; @endphp
                    @foreach ($locations as $location)
                    @php $counter++; @endphp
                    <tr>
                        <td>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{$counter}} </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            {{$location->value}}
                        </th>
                        <th>
                            <button type="submit" class="btn btn-primary" onclick="window.location.href='{{route('user.prepCourse.create',['id'=>$location->id])}}'">Register</button>
                        </th>
                        </td>
                        @endforeach
                  

                </thead>
               
            </table>
            <div class="px-3 pt-4">
                {{ $locations->links() }}
            </div>

        </div>

    </div>
@endsection
