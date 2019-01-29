@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="card-title">
                            My Profile
                        </h3>
                        <p class="card-text">
                            <a href="{{ route('employee.edit', $user) }}" class="btn btn-primary btn-sm btn-outline-dark">Edit Profile</a>
                            <a href="{{ route('management.change-password') }}" class="btn btn-primary btn-sm btn-outline-dark">Change Password</a>
                        </p>
                        <p class="card-text">
                            <strong>First Name: </strong>{{ $user->first_name ?? "Not set" }}<br>
                        </p>
                        <p class="card-text">
                            <strong>Last Name: </strong>{{ $user->last_name ?? "Not set" }}<br>
                        </p>
                        <p class="card-text">
                            <strong>Username: </strong>{{ $user->username ?? "Not set" }}<br>
                        </p>
                        <p class="card-text">
                            <strong>Email: </strong>{{ $user->email ?? "Not set" }}<br>
                        </p>
                        <p class="card-text">
                            <strong>Gender: </strong>{{ $user->gender ?? "Not set" }}<br>
                        </p>
                        <p class="card-text">
                            <strong>Date of Birth: </strong>{{ optional($user->date_of_birth)->toDateString() ?? "Not set" }}<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
