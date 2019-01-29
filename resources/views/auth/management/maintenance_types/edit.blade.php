@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="card-title">
                            Edit maintenance type
                        </h3>
                        <p class="card-text">
                        <form action="{{ route('maintenance-types.edit.post') }}" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $maintenanceType->name }}">
                                @if($errors->has('name'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Icon</label>
                                <ul class="choose-icons">
                                    @foreach($icons as $icon)
                                        <li>
                                            <i class="{{ $icon['class'] }} fa-4x"></i>
                                            <span style="display: block; text-align: center; word-wrap: break-word;" >{{ $icon['name'] }}</span>
                                            <label><input type="radio" value="{{ $icon['class'] }}" name="icon_type" {{ $maintenanceType->icon_type === $icon['class'] ? "checked" : ""}}></label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" name="type_id" value="{{ $maintenanceType->id }}">
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