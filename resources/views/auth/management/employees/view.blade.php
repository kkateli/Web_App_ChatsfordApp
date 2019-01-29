@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="card-title">
                            {{ $employee->name() }}
                        </h3>
                        <p class="card-text">
                            <strong>Date of Birth</strong><br>
                            @if ($employee->date_of_birth)
                                {{ $employee->date_of_birth->format('Y-m-d') }} ({{ now()->diffInYears($employee->date_of_birth) }} years)
                            @else
                                Not set
                            @endif
                        </p>
                        <p class="card-text">
                            <strong>Gender</strong><br>
                            {{ $employee->gender ?? "Not set" }}
                        </p>

                        <p class="card-text">
                            <strong>Login name</strong><br>
                            {{ $employee->username ?? "Not set" }}
                        </p>

                        <p class="card-text">
                            <strong>Email address</strong><br>
                            {{ $employee->email_address ?? "Not set" }}
                        </p>

                        <p class="card-text">
                            <strong>Status</strong><br>
                            {{ $employee->isActive() ? "Active" : "Inactive" }}
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="card-title">&nbsp;</h5>
                        <p class="card-text">
                            <strong>Type</strong><br>
                            {{ $employee->type ?? "Not set" }}
                        </p>
                        <p class="card-text">
                            <strong>Actions</strong><br>
                            <a class="edit" href="{{ route('employee.edit', $employee) }}">
                                <i class="far fa-edit eye edit"></i>
                                Edit
                            </a>
                            <br>
                            <a class="edit" href="{{ route('management.user.reset-password', $employee) }}">
                                <i class="fas fa-undo reseticon"></i>
                                Reset Password
                            </a>
                        </p>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection