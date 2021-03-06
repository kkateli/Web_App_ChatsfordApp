@extends('layout.master')
@section('content')
@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/classic.css') }}" id="theme_base">
    <link rel="stylesheet" href="{{ asset('assets/css/classic.date.css') }}" id="theme_date">
@endpush
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Update {{ $user->first_name }}'s Information</h3>
                    <form action="{{ route('resident.edit.post') }}" method="post">

                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>First name</label>
                                    <input type="text" class="form-control" placeholder="First name" name="first_name"
                                           value="{{ $user->first_name }}">
                                    @if($errors->has('first_name'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('first_name') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" placeholder="Last name" name="last_name"
                                           value="{{ $user->last_name }}">
                                    @if($errors->has('last_name'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('last_name') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="Username" name="username"
                                           value="{{ $user->username }}">
                                    @if($errors->has('username'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('username') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-2 text-center">
                                    <label></label>
                                    <p class="form-control-static">OR</p>
                                </div>
                                <div class="col-md-5">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Email address"
                                           name="email" value="{{ $user->email }}">
                                    @if($errors->has('email'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('email') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Gender</label>
                                    <select class="form-control select2" name="gender">
                                        <option disabled>--</option>
                                        <option value="male" {{ $user->gender === "male" ? "selected" : "" }}>Male</option>
                                        <option value="female" {{ $user->gender === "female" ? "selected" : "" }}>Female
                                        </option>
                                        <option value="other" {{ $user->gender === "other" ? "selected" : "" }}>Other
                                        </option>
                                    </select>
                                    @if($errors->has('gender'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('gender') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Date of birth</label>
                                    <input type="text" class="form-control datepicker" placeholder="Date of birth" name="date_of_birth" data-value="{{ optional($user->date_of_birth)->format('Y-m-d') }}">
                                    @if($errors->has('date_of_birth'))
                                        <div class="error mt-1">
                                            <span class="fa fa-exclamation-circle"
                                                  aria-hidden="true"></span> {{ $errors->first('date_of_birth') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Home</label>
                            <select name="home_id" class="form-control select2">
                                <option selected disabled="">--</option>
                                @forelse($homes as $home)
                                    @if($home->id == optional($user->home)->id)
                                        <option value="{{ $home->id }}" selected>{{ $home->name }}</option>
                                    @else
                                        <option value="{{ $home->id }}">{{ $home->name }}</option>
                                    @endif
                                @empty

                                @endforelse
                            </select>
                            @if($errors->has('home'))
                            <div class="error mt-1">
                                <span class="fa fa-exclamation-circle"
                                      aria-hidden="true"></span> {{ $errors->first('home') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control select2">
                                <option disabled>--</option>
                                <option value="1" {{ $user->status === 1 ? "selected" : "" }}>Active</option>
                                <option value="0" {{ $user->status === 0 ? "selected" : "" }}>Inactive</option>
                            </select>
                            @if($errors->has('last_name'))
                            <div class="error mt-1">
                                <span class="fa fa-exclamation-circle"
                                      aria-hidden="true"></span> {{ $errors->first('last_name') }}
                            </div>
                            @endif
                        </div>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-outline-dark">Submit</button>
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