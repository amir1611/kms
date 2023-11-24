@extends('layouts.staffNav')

@section('main-content')
    <div class="col-lg-12 order-lg-1">

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Consultation</h6>
            </div>
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Name
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
                                       {{$data->applicant->user->name}}</p>
                                       
                                       <p class="text-sm font-weight-bold mb-0">
                                        {{$data->applicant->user->ic}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">
                                       {{$data->spouse->name}}</p>
                                    <p class="text-sm font-weight-bold mb-0">
                                       {{$data->spouse->ic}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">
                                       {{$data->created_at}}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">
                                        {{$data->status->value}}</p>
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <span class="ml-4">

                                            <a class="text-primary me-3" href="{{route('staff.consultation.edit', ['id' => $data->id])}}"><i class="fas fa-pencil-alt fa-lg" aria-hidden="true"></i></a>
                                        </span>
                                            <span class="ml-4">
                                                <a class="text-success me-3" href="{{route('staff.consultation.show', ['id' => $data->id])}}"><i class="fas fa-eye fa-lg" aria-hidden="true"></i></a>

                                            </span>
                                            <span class="ml-4">
                                                <form method="POST" action="{{ route('staff.consultation.decline', ['id' => $data->id]) }}" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-link p-0 border-0 bg-transparent">
                                                        <i class="fas fa-times fa-lg text-danger" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        {{-- <a class="text-success me-3"><i class="fa fa-pencil-square-o fa-lg"
                                                aria-hidden="true"></i></a>
                                        <a class="text-danger" href="#"><i class="fa fa-trash-o fa-lg"
                                                aria-hidden="true"></i></a> --}}
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
                </tbody>
            </table>
            <div class="px-3 pt-4">
                {{ $datas->links() }}
            </div>

        </div>

    </div>
@endsection
