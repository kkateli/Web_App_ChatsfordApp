@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <h3 class="mb-3">Quick Search</h3>
    <form method="get" action="{{ route('management.search') }}">
        <div class="form-group">
            <div class="input-group">
                <input class="form-control py-2" type="search" name="q" id="example-search-input" placeholder="Search something...">
                <span class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </div>
    </form>
    <h3 class="mb-3">Community Overview</h3>
    <table class="table table-bordered dashboard">
        <tbody>
            <tr>
                <td class="mandashtable">
                    <a href="{{ route('jobs') }}">
                        <i class="fas fa-wrench fa-8x dashicon"></i>
                        <p class="mandashnumbers">{{ $requestcount }}</p>
                        <p class="dashnames">Open Maintenance {{ str_plural('Job', $requestcount) }}</p>
                    </a>
                </td>
                <td class="mandashtable">
                    <a href="{{ route('management.complaints') }}">
                        <img src="{{ asset('assets/images/complaint.png') }}" alt="complaint" id="dashicon-complaint">
                        <p class="mandashnumbers">{{ $complaints }}</p>
                        <p class="dashnames">Open {{ str_plural('Complaint', $complaints) }}</p>
                    </a>
                </td>
                <td class="mandashtable">
                    <a href="{{ route('events') }}">
                        <i class="far fa-calendar-alt fa-8x dashicon"></i>
                        <p class="mandashnumbers">{{ $eventcount }}</p>
                        <p class="dashnames">{{ str_plural('Activity', $eventcount) }} Today</p>
                    </a>
                </td>
            </tr>
            <tr>

                <td class="mandashtable">
                    <a href="{{ route('homes') }}">
                        <i class="fas fa-home fa-8x dashicon"></i>
                        <p class="mandashnumbers">{{ $homecount }}</p>
                        <p class="dashnames">{{ str_plural('Home', $homecount) }}</p>
                    </a>
                </td>
                <td class="mandashtable">
                    <a href="{{ route('residents') }}">
                        <i class="fas fa-user fa-8x dashicon"></i>
                        <p class="mandashnumbers">{{ $residentcount }}</p>
                        <p class="dashnames">{{ str_plural('Resident', $residentcount) }}</p>
                    </a>
                </td>
                <td class="mandashtable">
                    <a href="{{ route('employees') }}">
                        <img src="{{ asset('assets/images/employee.png') }}" alt="employee" id="dashicon-employee">
                        <p class="mandashnumbers">{{ $employeecount }}</p>
                        <p class="dashnames">{{ str_plural('Employee', $employeecount) }}</p>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
