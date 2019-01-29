@extends('layout.master')
@section('content')
<div class="main">

    @include('layout.messages')

    <h3 id="residenttitle">Upcoming Activities</h3>
    <div class="clearfix"></div>
    <a href="{{ route('resident.events') }}" class="edit"><i class="far fa-calendar-alt"></i> Your activities</a> | <a href="{{ route('resident.events.upcoming') }}" class="edit"><i class="far fa-calendar-alt"></i> Upcoming activities</a> | <a href="{{ route('resident.events.past') }}" class="edit"><i class="fas fa-undo"></i> Past activities</a>

    @if($events->count() > 0)
    <div class="row mt-2">
        @foreach($events as $event)
        <div class="col-sm-4">
            <div id="event-block" class="card text-center" style="margin-bottom: 10px;">
                <div id="event-header" class="card-header">
                    <h5 class="card-title">
                        {{ $event->title }}
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $event->description }}</p>
                    <p class="card-text">{{ $event->getTime() }}</p>
                    @if ($event->location)
                    <p class="card-text">{{ $event->location }}</p>
                    @endif

                    <form action="{{ route('residents.events.register-interest.post') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-link register">Register your interest</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        <hr>
    </div>
    @else
    <p class="mb-1 mt-2">There are currently no upcoming activities.</p>
    @endif
</div>
@endsection