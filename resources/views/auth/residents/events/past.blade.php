@extends('layout.master')
@section('content')
<div class="main">
   
    @include('layout.messages')

    <h3 id="residenttitle">Past Activities</h3>
    <div class="clearfix"></div>
    <a href="{{ route('resident.events') }}" class="edit"><i class="far fa-calendar-alt"></i> Your activities</a> | <a href="{{ route('resident.events') }}" class="edit"><i class="far fa-calendar-alt"></i> Upcoming activities</a> | <a href="{{ route('resident.events.past') }}" class="edit"><i class="fas fa-undo"></i> Past activities</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-2">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>When</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->getTime() }}</td>
                        <td>{{ $event->location ?? "Not set" }}</td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="5">There are currently no past events</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection