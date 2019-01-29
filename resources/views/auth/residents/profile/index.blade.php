@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <table class="table table-bordered dashboard">
        <tbody>
            <tr>
                <td class="resdashtable">
                    <a href="{{ route('resident.events') }}">
                        <i class="fas fa-calendar-alt fa-3x dashicon"></i>
                        <p class="resdashnumbers">{{ $activitiesToday }}</p>
                        <p class="dashnames">{{ str_plural('Activity', $activitiesToday) }} Today</p>
                    </a>
                </td>
                <td class="resdashtable">
                    <a href="{{ route('resident.jobs') }}">
                        <i class="fas fa-wrench fa-3x dashicon"></i>
                        <p class="resdashnumbers">{{ $openJobs }}</p>
                        <p class="dashnames">Open Maintenance {{ str_plural('Job', $openJobs) }}</p>
                    </a>
                </td>
                <td class="resdashtable">
                    <a href="{{ route('resident.complaints') }}">
                        <img src="{{ asset('assets/images/complaint.png') }}" alt="complaint" id="resident-complaint">
                        <p class="resdashnumbers">{{ $openComplaints }}</p>
                        <p class="dashnames">Open {{ str_plural('Complaints', $activitiesToday) }}</p>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="card-title">
                        My Profile
                    </h3>
                    <p class="card-text">
                        <a href="{{ route('user.edit') }}" class="btn btn-primary btn-sm btn-outline-dark">Edit
                            Profile</a>
                        <a href="{{ route('user.change-password') }}" class="btn btn-primary btn-sm btn-outline-dark">Change Password</a>
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
                    <p class="card-text">
                        <strong>Residence: </strong>{{ optional($user->home)->address() ?? "Not set" }}<br>
                    </p>
                    <p class="card-text">
                        <strong>Area: </strong>{{ optional(optional($user->home)->area)->name ?? "Not set" }}<br>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection