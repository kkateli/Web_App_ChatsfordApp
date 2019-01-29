@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="card-title">
                        Add Area
                    </h3>
                    <p class="card-text">
                    <form action="{{ route('area.add.post') }}" method="post">
                        <div class="form-group col-md-12">
                            <label>Area name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name">
                            @if($errors->has('name'))
                            <div class="error mt-1">
                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        {{ csrf_field() }}
                        <div class="form-group col-md-5">
                            <button type="submit" class="btn btn-primary btn-outline-dark">Submit</button>
                        </div>
                    </form>
                    <p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection