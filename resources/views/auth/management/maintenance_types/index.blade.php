@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <h3 id="residenttitle">Maintenance types</h3>
        <a href="{{ route('maintenance-types.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Add New</a>
        <table class="table table table-striped table-bordered">
            <thead>
                <th>Type</th>
                <th class="text-center">Icon</th>
                <th class="text-center">View</th>
            </thead>
            <tbody>
            @forelse($types as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td class="text-center">
                        @if($type->icon_type)
                            <i class="{{ $type->icon_type }}"></i>
                        @else
                            Not set
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('maintenance-types.view', $type) }}">
                            <i class="far fa-eye fa-lg view"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="3">There are currently no maintenance types in the system</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $types->links() }}
    </div>
@endsection