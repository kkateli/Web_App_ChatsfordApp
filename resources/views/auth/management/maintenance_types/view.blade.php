@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">
                            {{ $maintenanceType->name }}
                        </h5>
                        <p class="card-text"><strong>Icon</strong><br>
                            @if($maintenanceType->icon_type)
                                <i class="{{ $maintenanceType->icon_type }}"></i>
                            @else
                                Not set
                            @endif
                        </p>
                    </div>
                    <div class="col">
                        <p class="card-text">&nbsp;</p>
                        <p class="card-text"><strong>Actions</strong><br>
                            <a class="edit" href="{{ route('maintenance-types.edit', $maintenanceType) }}">
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
                            <td colspan="4" class="text-center">There are no jobs under this category</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
@endsection