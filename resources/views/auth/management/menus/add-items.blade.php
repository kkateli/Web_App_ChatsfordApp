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
                    <form action="{{ route('management.menus.add-days.post') }}" method="post">
                        @php
                            $startDate = $menu->start_date;
                        @endphp
                        @while($startDate->lte($menu->end_date))
                            <h5>{{ $startDate->format('l') }} {{ $startDate->format('dS M') }}</h5>
                            <div class="form-group">
                                <label>Lunch</label>
                                <textarea rows="5" name="dates[{{ $startDate->toDateString() }}][lunch]" class="form-control" placeholder="Lunch"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Dinner</label>
                                <textarea rows="5" name="dates[{{ $startDate->toDateString() }}][dinner]" class="form-control" placeholder="Dinner"></textarea>
                            </div>
                            @php
                                $startDate->addDay(1);
                            @endphp
                        @endwhile

                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
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
        /**
         * Show the date and time pickers
         */
        $('.datepicker').pickadate({
            formatSubmit: "yyyy-mm-dd"
        });

    </script>
@endpush
@endsection