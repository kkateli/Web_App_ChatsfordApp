@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <h3 id="residenttitle">Maintenance requests @if($showType) - {{ $type->name }} @endif</h3>
        <a href="{{ route('maintenance.jobs.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Submit New</a>
        <div class="clearfix"></div>
        <p class="pull-left">
            @if(isset($closed) && $closed)
                    <a maintjobs href="{{ route('maintenance.jobs') }}">
                    <i class="far fa-check-circle"></i>
                    View open jobs
                </a>
            @else
                <a class="maintjobs" href="{{ route('jobs.closed') }}">
                    <i class="far fa-times-circle"></i>
                    View closed jobs
                </a>
            @endif
        </p>
        <table class="table table table-striped table-bordered">
            <thead>
                <th>Title</th>
                <th>Submitted by</th>
                <th>Type</th>
                <th class="text-center">Status</th>
                <th class="text-center">View</th>
            </thead>
            <tbody>
            @forelse($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->submittedBy->name() }}</td>
                    <td>{{ optional($job->maintenance_type)->name ?? "Not set" }}</td>
                    <td class="text-center">{!! $job->displayStatus()  !!}</td>
                    <td class="text-center">
                        <a href="{{ route('maintenance.job', $job) }}">
                            <i class="far fa-eye fa-lg eye view"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="6">There are currently no open maintenance requests</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection