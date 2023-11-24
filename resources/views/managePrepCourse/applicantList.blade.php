@extends('layouts.staffNav')

@section('main-content')
    <div class="col-lg-12 order-lg-1">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Marriage Preparation Course</h6>
            </div>
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                        </th> --}}
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Organizer
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$datas->isEmpty())
                        @php $counter = 0; @endphp
                        @foreach ($list as $applicantList)
                            @php $counter++; @endphp
                            <tr>
                                {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                                </th> --}}
                                <th>{{$list['id']}}</th>
                                <th>{{$list['ref_location_id']}}</th>
                                <th>{{$list['status']}}</th>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="align-middle text-center">
                                <p class="text-sm font-weight-bold mb-0">There is no property
                                    available.
                                </p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="px-3 pt-4">
                {{ $datas->links() }}
            </div>

        </div>

    </div>
@endsection
