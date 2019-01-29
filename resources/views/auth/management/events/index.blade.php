@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <h3 id="residenttitle">Activities</h3>
    <a href="{{ route('events.add') }}"  class="btn btn-primary btn-sm btn-outline-dark">Add New</a>
    {{-- HIDING CALENDAR FOR THE MEANTIME --}}
    {{--<div id='thecalendar'></div>--}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <th>Title</th>
            <th>When</th>
            <th>Location</th>
            <th>Interested</th>
            <th>View</th>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->start_datetime->format('jS \o\f F, Y - g:i A') }}</td>
                    <td>{{ $event->location ?? "Not set" }}</td>
                    <td class="text-center">
                        {{ $event->interested_users_count }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('event', $event) }}">
                            <i class="far fa-eye fa-lg eye view"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No events in the system</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $events->links() }}
    </div>
</div>
@endsection
