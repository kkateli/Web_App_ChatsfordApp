@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">
                            {{ $home->address() }}
                        </h5>
                        <p class="card-text"><strong>Current Residents</strong><br>
                            @forelse($home->residents as $resident)
                                {{ $resident->name() }}@if(!$loop->last)<br>@endif
                            @empty
                                None set
                            @endforelse
                        </p>
                    </div>
                    <div class="col">
                        <h5 class="card-title">&nbsp;</h5>
                        <p class="card-text">
                            <strong>Actions</strong><br>
                            <a class="edit" href="{{ route('home.edit', $home) }}">
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
                <h4>Maintenance Jobs</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Title</th>
                        <th>Submitted by</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
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
                            <tr>
                                <td colspan="4" class="text-center">This home hasn't had any maintenance jobs assigned to it</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
@endsection