@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Update Menu Day - {{ $menuDay->date->format('dS M') }}</h3>
                        <form action="{{ route('management.menu.edit-day.post') }}" method="post">

                            <div class="form-group">
                                <label>Lunch</label>
                                <textarea rows="5" name="lunch" class="form-control" placeholder="Lunch">{{ $menuDay->lunch }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Dinner</label>
                                <textarea rows="5" name="dinner" class="form-control" placeholder="Dinner">{{ $menuDay->dinner }}</textarea>
                            </div>

                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" name="day_id" value="{{ $menuDay->id }}">
                                <button type="submit" class="btn btn-primary btn-outline-dark">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection