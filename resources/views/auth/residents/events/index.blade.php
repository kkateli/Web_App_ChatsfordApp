@extends('layout.master')
@section('content')
<div class="main">
   
    @include('layout.messages')

    <h3 id="residenttitle">Activities</h3>
    <div class="clearfix"></div>
    <a href="{{ route('resident.events') }}" class="edit"><i class="far fa-calendar-alt"></i> Your activities</a> | <a href="{{ route('resident.events.upcoming') }}" class="edit"><i class="far fa-calendar-alt"></i> Upcoming activities</a> | <a href="{{ route('resident.events.past') }}" class="edit"><i class="fas fa-undo"></i> Past activities</a>
    @if($userUpcomingEvents->count() > 0)
        <div class="row mt-2">
            @foreach($userUpcomingEvents as $upcomingEvent)
                <div class="col-sm-4">
                    <div id="event-block" class="card text-center" style="margin-bottom: 10px;">
                        <div id="event-header" class="card-header">
                            <h5 class="card-title">
                                {{ $upcomingEvent->title }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $upcomingEvent->description }}</p>
                            <p class="card-text">{{ $upcomingEvent->getTime() }}</p>
                            @if ($upcomingEvent->location)
                                <p class="card-text">{{ $upcomingEvent->location}}</p>
                            @endif

                            <form action="{{ route('residents.events.deregister-interest.post') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="event_id" value="{{ $upcomingEvent->id }}">
                                <button type="submit" class="btn btn-link register"><i class="fas fa-ban"></i> Cancel your interest</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            <hr>
        </div>
    @else
        <p class="mb-1 mt-2">You have no upcoming events that you've registered interest for.</p>
    @endif
</div>


    {{--<a href="" class="edit">Upcoming events</a>|<a href="" class="edit">Past events</a>--}}
        {{--<table class="table table-bordered table-striped">--}}
            {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>Title</th>--}}
                    {{--<th>Description</th>--}}
                    {{--<th>When</th>--}}
                    {{--<th>Location</th>--}}
                    {{--<th>Actions</th>--}}
                {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
                {{--@forelse($events as $event)--}}
                    {{--<tr>--}}
                        {{--<td>{{ $event->title }}</td>--}}
                        {{--<td>{{ $event->description }}</td>--}}
                        {{--<td>{{ $event->start_datetime->format('jS \o\f F, Y - g:i A') }}</td>--}}
                        {{--<td>{{ $event->location ?? "Not set" }}</td>--}}
                        {{--<td>--}}
                            {{--<form action="{{ route('residents.events.register-interest.post') }}" method="post">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<input type="hidden" name="event_id" value="{{ $event->id }}">--}}
                                {{--<button type="submit" class="btn btn-link register">Register your interest</button>--}}
                            {{--</form>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@empty--}}
                    {{--<tr class="text-center">--}}
                        {{--<td colspan="5">There are currently no events to register for</td>--}}
                    {{--</tr>--}}
                {{--@endforelse--}}
            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}
@endsection