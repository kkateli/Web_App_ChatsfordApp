@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="card-title">
                            {{ $resident->name() }}
                        </h3>
                        <p class="card-text">
                            <strong>Date of Birth</strong><br>
                            @if ($resident->date_of_birth)
                                {{ $resident->date_of_birth->format('Y-m-d') }}
                                ({{ now()->diffInYears($resident->date_of_birth) }} years)
                            @else
                                Not set
                            @endif
                        </p>
                        <p class="card-text">
                            <strong>Gender</strong><br>
                            {{ $resident->gender ?? "Not set" }}
                        </p>

                        <p class="card-text">
                            <strong>Login name</strong><br>
                            {{ $resident->username ?? "Not set" }}
                        </p>

                        <p class="card-text">
                            <strong>Email address</strong><br>
                            {{ $resident->email ?? "Not set" }}
                        </p>

                        <p class="card-text">
                            <strong>Status</strong><br>
                            {{ $resident->isActive() ? "Active" : "Inactive" }}
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="card-title">&nbsp;</h5>
                        <p class="card-text">
                            <strong>Residence</strong><br>
                            {{ optional($resident->home)->name ?? "Not set" }}
                        </p>
                        <p class="card-text">
                            <strong>Area</strong><br>
                            {{ optional(optional($resident->home)->area)->name ?? "Not set" }}
                        </p>
                        <p class="card-text">
                            <strong>Actions</strong><br>
                            <a class="edit" href="{{ route('resident.edit', $resident) }}">
                                <i class="far fa-edit eye edit"></i>
                                Edit
                            </a>
                            <br>
                            <a class="edit" href="{{ route('management.user.reset-password', $resident) }}">
                                <i class="fas fa-undo reseticon"></i>
                                Reset Password
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Maintenance Jobs</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Title</th>
                        <th>Submitted by</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">View</th>
                    </thead>
                    <tbody>
                    @forelse($jobs as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->submittedBy->name() }}</td>
                            <td class="text-center">{!! $job->displayStatus()  !!}</td>
                            <td class="text-center">
                                <a href="{{ route('job', $job) }}">
                                    <i class="far fa-eye fa-lg eye view"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="4">This user hasn't submitted any maintenance jobs</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Complaints</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Title</th>
                        <th>Submitted by</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">View</th>
                    </thead>
                    <tbody>
                    @forelse($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->title }}</td>
                            <td>{{ $complaint->submittedBy->name() }}</td>
                            <td class="text-center">{!! $complaint->displayStatus()  !!}</td>
                            <td class="text-center">
                                <a href="{{ route('common.complaints.view', $complaint) }}">
                                    <i class="far fa-eye fa-lg eye view"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="4">This user hasn't submitted any complaints</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection