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
                    <h3>Add Menu</h3>
                    <form action="{{ route('management.menus.add.post') }}" method="post">
                        <div class="form-group">
                            <label>Start date</label>
                            <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="Click to select a date">
                            @if($errors->has('start_date_submit'))
                                <div class="error mt-1">
                                    <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('start_date_submit') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>End date</label>
                            <input type="text" class="form-control datepicker" name="end_date" id="end_date" placeholder="Click to select a date">
                            @if($errors->has('end_date_submit'))
                                <div class="error mt-1">
                                    <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('end_date_submit') }}
                                </div>
                            @endif
                        </div>

                        {{ csrf_field() }}
                        <div class="form-group">
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

    <script>
        $(document).ready(function() {
            /**
             * Show the date and time pickers
             */
            $('.datepicker').pickadate({
                formatSubmit: "yyyy-mm-dd"
            });

            var from_picker = $("#start_date").pickadate('picker');
            var to_picker   = $("#end_date").pickadate('picker');

            from_picker.on('set', function(event) {
                if ( event.select ) {

                    var selected = from_picker.get('select');

                    var date = new Date(selected.year, selected.month, selected.date);

                    date.setDate(date.getDate() + 7);

                    to_picker.set('select', date);
                }
            });
        });
    </script>
@endpush
@endsection