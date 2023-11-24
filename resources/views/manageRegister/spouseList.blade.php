@extends('layouts.userNav')

@section('main-content')
<div class="col-lg-12 order-lg-1">

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Spouse List</h6>
        </div>
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Spouse IC
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Spouse
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Date
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Status
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
                                   {{$data->applicant->user->name}}</p>
                            </td>
                            <td>
                                <p class="text-sm font-weight-bold mb-0">
                                    {{$data->spouse->name}}</p>
                            </td>
                            <td>
                                <p class="text-sm font-weight-bold mb-0">
                                   {{$data->created_at->format('Y-m-d')}}</p>
                            </td>
                            <td>
                                <p class="text-sm font-weight-bold mb-0">
                                    Status</p>
                            </td>
                            <td class="align-middle text-end">
                                <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                    <a class="text-info me-3" href="{{route('staff.consultation.edit', ['id' => $data->id])}}"><i class="fas fa-eye fa-lg" aria-hidden="true"></i></a>
                                </div>
                            </td>
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
                <tr>
                    <td colspan="3" class="align-middle text-center">
                        <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('user.register.create')}}'">Add New</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('user.register.manageUser')}}'">Manage Registration</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="px-3 pt-4">
            {{ $datas->links() }}
        </div>

    </div>

</div>

@endsection