@extends('layouts.userNav')

@section('main-content')
    <div class="col-lg-12 order-lg-1">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pl-lg-4">
                    <div class="row">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Marriage Request</h6>
                        <div class="col text-right">
                            <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('user.application.create')}}'">Add New</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Marriage Request</h6>
            </div>
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Applicant
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Spouse
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Wedding Date
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$datas->isEmpty())
                        @php $counter = 0; @endphp
                        @foreach ($datas as $data)
                            @php $counter++; @endphp
                            <tr>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0 ms-3">{{ $counter }}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">
                                       {{$data->applicant->user_id->id}} data</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">
                                       {{$data->id}} Spouse</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">
                                       {{$data->created_at->format('Y-m-d')}} wedding date</p>
                                </td>
                                {{-- <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <a class="text-info me-3" href="{{route('staff.consultation.edit', ['id' => $data->id])}}"><i class="fas fa-eye fa-lg" aria-hidden="true"></i></a>
                                        <a class="text-success me-3"><i class="fa fa-pencil-square-o fa-lg"
                                                aria-hidden="true"></i></a>
                                        <a class="text-danger" href="#"><i class="fa fa-trash-o fa-lg"
                                                aria-hidden="true"></i></a>
                                    </div>
                                </td> --}}
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
