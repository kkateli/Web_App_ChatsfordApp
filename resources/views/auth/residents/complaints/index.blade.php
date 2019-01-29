@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <h3 id="residenttitle">Complaints</h3>
        <a href="{{ route('resident.complaints.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Submit New</a>
        <div class="clearfix"></div>
        <p class="pull-left">
            @if(isset($closed) && $closed)
                <a class="maintjobs" href="{{ route("resident.complaints") }}">
                    <i class="far fa-check-circle maintjobs"></i>
                    View open complaints
                </a>
            @else
                <a class="maintjobs" href="{{  route("resident.complaints.resolved") }}">
                    <i class="far fa-times-circle maintjobs"></i>
                    View resolved complaints
                </a>
            @endif
        </p>
        <table class="table table table-striped table-bordered">
            <thead>
            <th>Title</th>
            <th>Submitted</th>
            <th class="text-center">View</th>
            </thead>
            <tbody>
            @forelse($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->title }}</td>
                    <td>{{ $complaint->created_at->diffForHumans() }}</td>
                    <td class="text-center">
                        <a href="{{ route('common.complaints.view', $complaint) }}">
                            <i class="far fa-eye fa-lg view"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="4">You currently have no open complaints</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $complaints->links() }}
    </div>
@endsection