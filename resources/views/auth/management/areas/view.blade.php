@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">
                            {{ $area->name }}
                        </h5>
                        <p class="card-text"><strong>Actions</strong><br>
                            <a class="edit" href="{{ route('areas.edit', $area) }}">
                                <i class="far fa-edit eye edit"></i>
                                Edit
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Homes</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Address</th>
                        <th>Area</th>
                        <th>Residents</th>
                        <th class="text-center">View</th>
                    </thead>
                    <tbody>
                        @forelse($homes as $home)
                            <tr>
                                <td>{{ $home->address() }}</td>
                                <td>{{ optional($home->area)->name ?? "Not set" }}</td>
                                <td>
                                    @forelse($home->residents as $resident)
                                        {{ $resident->name() }}@if(!$loop->last),@endif
                                    @empty
                                        Not set
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('home.view', $home) }}">
                                        <i class="far fa-eye fa-lg view"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="3">
                                    There are no homes in the system
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $homes->links() }}
            </div>
        </div>
    </div>
@endsection