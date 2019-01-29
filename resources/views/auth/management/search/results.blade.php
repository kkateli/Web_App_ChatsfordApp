@extends('layout.master')
@section('content')
    <div class="main">
        @if($users->count() === 0 && $homes->count() === 0 && $areas->count() === 0)
            <h3>No results found for {{ $query }}</h3>
            <form method="get" action="{{ route('management.search') }}">
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control py-2" type="search" name="q" id="example-search-input" placeholder="Search something...">
                        <span class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                      </span>
                    </div>
                </div>
            </form>
        @else
            <h3>Showing results for {{ $query }}</h3>
            @if($users->count() > 0)
                <h5>Users</h5>
                <table class="table table table-striped table-bordered">
                    <thead>
                        <th>Name</th>
                        <th>Login</th>
                        <th>Type</th>
                        <th class="text-center">View</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name() }}</td>
                                <td>{{ $user->username ?? $user->email }}</td>
                                <td>
                                    {{ $user->type }}
                                </td>
                                @if($user->isManagement() || $user->isMaintenance())
                                    <td class="text-center">
                                        <a href="{{ route('employee.view', $user) }}">
                                            <i class="far fa-eye fa-lg view"></i>
                                        </a>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <a href="{{ route('resident.view', $user) }}">
                                            <i class="far fa-eye fa-lg view"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if ($homes->count() > 0)
                <h5>Homes</h5>
                <table class="table table table-striped table-bordered">
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
            @endif

            @if ($areas->count() > 0)
                <h5>Areas</h5>
                <table class="table table table-striped table-bordered">
                    <thead>
                    <th>Name</th>
                    <th class="text-center">View</th>
                    </thead>
                    <tbody>
                    @forelse($areas as $area)
                        <tr>
                            <td>{{ $area->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('areas.view', $area) }}">
                                    <i class="far fa-eye fa-lg eye view"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="3">
                                There are no areas in the system
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            @endif
        @endif
    </div>
@endsection