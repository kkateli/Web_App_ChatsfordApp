@extends('layout.master')
@section('content')
@push('head')
<link rel="stylesheet" href="{{ asset('assets/css/classic.css') }}" id="theme_base">
<link rel="stylesheet" href="{{ asset('assets/css/classic.date.css') }}" id="theme_date">
<link rel="stylesheet" href="{{ asset('assets/css/classic.time.css') }}" id="theme_time">
@endpush
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Edit Activity</h3>
                    <form action="{{ route('event.edit.post') }}" method="post">

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="Event title" name="title" value="{{ $event->title }}">
                            @if($errors->has('title'))
                            <div class="error mt-1">
                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('title') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Date</label>
                                    <input type="text" class="form-control datepicker" name="date" placeholder="Click to select a date" data-value="{{ $event->start_datetime->toDateString() }}">
                                    @if($errors->has('date_submit'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('date_submit') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Time</label>
                                    <input type="text" class="form-control timepicker" name="time" placeholder="Click to select a time" data-value="{{ $event->start_datetime->toTimeString() }}">
                                    @if($errors->has('time_submit'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('time_submit') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group event">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>End Date</label>
                                    <input type="text" class="form-control datepicker" name="end_date" placeholder="Click to select a date" id="enddate" data-value="{{ optional($event->end_datetime)->toDateString() }}">
                                    @if($errors->has('end_date_submit'))
                                        <div class="error mt-1">
                                            <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('end_date_submit') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label>End Time</label>
                                    <input type="text" class="form-control timepicker" name="end_time" placeholder="Click to select a time" id="endtime" data-value="{{ optional($event->end_datetime)->toTimeString() }}">
                                    @if($errors->has('end_time_submit'))
                                        <div class="error mt-1">
                                            <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('end_time_submit') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Location</label>
                                    <input type="text" class="form-control" placeholder="Location" name="location" value="{{ $event->location }}">
                                    @if($errors->has('location'))
                                        <div class="error mt-1">
                                            <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('location') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="inlineFormInputGroupUsername2">Cost</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" class="form-control" name="cost" id="inlineFormInputGroupUsername2" placeholder="52.50" value="{{ $event->cost }}">
                                    </div>
                                    @if($errors->has('cost'))
                                        <div class="error mt-1">
                                            <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('cost') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" placeholder="Description">{{ $event->description }}</textarea>
                            @if($errors->has('description'))
                            <div class="error mt-1">
                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('description') }}
                            </div>
                            @endif
                        </div>

                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <button type="submit" class="btn btn-primary btn-outline-dark">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/picker.js') }}"></script>
<script src="{{ asset('assets/js/picker.date.js') }}"></script>
<script src="{{ asset('assets/js/picker.time.js') }}"></script>

<script>
/**
* Show the date and time pickers
*/
$('.datepicker').pickadate({
formatSubmit: "yyyy-mm-dd"
});

$('.timepicker').pickatime({
formatSubmit: "HH:i"
});

</script>
@endpush
@endsection