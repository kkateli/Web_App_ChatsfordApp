@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Change password</h3>
                        <form action="{{ route('maintenance.change-password.post') }}" method="post">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="New password" name="password">
                                @if($errors->has('password'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Repeat password</label>
                                <input type="password" class="form-control" placeholder="Confirm password" name="password_confirm">
                                @if($errors->has('password_confirm'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('password_confirm') }}
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
@endsection