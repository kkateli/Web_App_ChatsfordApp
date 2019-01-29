@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Edit Area</h3>
                    <form action="{{ route('area.edit.post') }}" method="post">
                        <div class="form-group">
                            <label>Area name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $area->name }}">
                            @if($errors->has('name'))
                            <div class="error mt-1">
                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <input type='hidden' name='area_id' value='{{ $area->id }}'>
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
@endsection