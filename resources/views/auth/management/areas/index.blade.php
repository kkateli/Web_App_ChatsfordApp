@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="row">
        <div class="col-8">
            <h3 id="residenttitle">Areas</h3>
            <a href="{{ route('areas.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Add New</a>
        </div>
        <div class="col-4">
            <form method="get" action="{{ route('management.search') }}" style="margin-bottom: 0.5rem;">
                <div class="input-group">
                    <input class="form-control py-2" type="search" name="q" id="example-search-input" placeholder="Search areas...">
                    <input type="hidden" name="type" value="area">
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
    {{ $areas->links() }}
</div>
@endsection