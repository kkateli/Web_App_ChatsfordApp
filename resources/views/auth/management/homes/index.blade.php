@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="row">
            <div class="col-8">
                <h3 id="residenttitle">Homes</h3>
                <a href="{{ route('home.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Add New</a>
            </div>
            <div class="col-4">
                <form method="get" action="{{ route('management.search') }}" style="margin-bottom: 0.5rem;">
                    <div class="input-group">
                        <input class="form-control py-2" type="search" name="q" id="example-search-input" placeholder="Search homes...">
                        <input type="hidden" name="type" value="home">
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
@endsection