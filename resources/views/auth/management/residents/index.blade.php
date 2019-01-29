@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')

        <div class="row">
            <div class="col-8">
                <h3 id="residenttitle">Residents</h3>
                <a href="{{ route('resident.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Add New</a>
            </div>
            <div class="col-4">
                <form method="get" action="{{ route('management.search') }}" style="margin-bottom: 0.5rem;">
                    <div class="input-group">
                        <input class="form-control py-2" type="search" name="q" id="example-search-input" placeholder="Search residents...">
                        <input type="hidden" name="type" value="resident">
                        <span class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table table-striped table-bordered">
            <thead>
                <th>Name</th>
                <th>Login</th>
                <th>Gender</th>
                <th>Date of birth</th>
                <th class="text-center">View</th>
            </thead>
            <tbody>
            @foreach($residents as $resident)
                <tr>
                    <td>{{ $resident->name() }}</td>
                    <td>{{ $resident->username ?? $resident->email }}</td>
                    <td>{{ $resident->gender ?? "Not set" }}</td>
                    @if ($resident->date_of_birth)
                        <td>{{ $resident->date_of_birth->format('Y-m-d') }}
                            ({{ now()->diffInYears($resident->date_of_birth) }} years)
                        </td>
                    @else
                        <td>Not set</td>
                    @endif
                    <td class="text-center">
                        <a href="{{ route('resident.view', $resident) }}">
                            <i class="far fa-eye fa-lg view"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $residents->links() }}
    </div>
@endsection