@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <h3 id="residenttitle">Maintenance requests</h3>
        <a href="{{ route('jobs.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Submit New</a>
        <div class="clearfix"></div>
        <p class="pull-left">
            @if(isset($closed) && $closed)
                <a class="maintjobs" href="{{ route(auth()->user()->isManagement() ? "jobs" : "maintenance.jobs") }}">
                    <i class="far fa-check-circle maintjobs"></i>
                    View open jobs
                </a>
            @else
                <a class="maintjobs" href="{{ route('jobs.closed') }}">
                    <i class="far fa-times-circle maintjobs"></i>
                    View closed jobs
                </a>
            @endif
        </p>
        <table class="table table table-striped table-bordered">
            <thead>
                <th>Title</th>
                <th>Submitted by</th>
                <th>Submitted</th>
                <th>Type</th>
                <th class="text-center">Status</th>
                <th class="text-center">View</th>
            </thead>
            <tbody>
            @forelse($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ optional($job->submittedBy)->name() ?? "Entered by management" }}</td>
                    <td>{{ $job->created_at->diffForHumans() }}</td>
                    <td>{{ optional($job->maintenance_type)->name ?? "Not set" }}</td>
                    <td class="text-center">{!! $job->displayStatus()  !!}</td>
                    <td class="text-center">
                        <a href="{{ route('job', $job) }}">
                            <i class="far fa-eye fa-lg eye view"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    @if (isset($closed) && $closed)
                        <td colspan="6">There are currently no closed maintenance requests</td>
                    @else
                        <td colspan="6">There are currently no open maintenance requests</td>
                    @endif
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $jobs->links() }}
    </div>
@endsection