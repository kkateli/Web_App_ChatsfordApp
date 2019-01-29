@extends('layout.master')
@section('content')
    @push('head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    @endpush
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Update home</h3>
                        <form action="{{ route('home.edit.post') }}" method="post">
                            <div class="form-group">
                                <label>House number</label>
                                <input type="text" class="form-control" placeholder="House number" name="number"
                                       value="{{ $home->number }}">
                                @if($errors->has('number'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('number') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>House name</label>
                                <input type="text" class="form-control" placeholder="House name" name="name"
                                       value="{{ $home->name }}">
                                @if($errors->has('name'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Area</label>
                                <select class="select2 form-control" name="area_id">
                                    <option selected disabled="">--</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}" {{ $area->id === optional($home->area)->id ? "selected" : "" }}>{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type='hidden' name='home_id' value='{{ $home->id }}'>

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.select2').select2();
            });
        </script>
    @endpush
@endsection