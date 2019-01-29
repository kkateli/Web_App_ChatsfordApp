@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="row">
        <div class="col-8">
            <h3 id="employeetitle">Employees</h3>
            <a href="{{ route('employee.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Add New</a>
        </div>
        <div class="col-4">
            <form method="get" action="{{ route('management.search') }}" style="margin-bottom: 0.5rem;">
                <div class="input-group">
                    <input class="form-control py-2" type="search" name="q" id="example-search-input" placeholder="Search employees...">
                    <input type="hidden" name="type" value="employee">
                    <span class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
            </form>
        </div>
    </div>

    <table class="table table table-striped table-bordered">
        <thead>
            <th>Name</th>
            <th>Login</th>
            <th>Position</th>
            <th class="text-center">View</th>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name() }}</td>
                <td>{{ $employee->username ?? $employee->email }}</td>
                <td>{{ $employee->type() }}</td>
                <td class="text-center">
                    <a href="{{ route('employee.view', $employee) }}">
                        <i class="far fa-eye fa-lg eye view"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $employees->links() }}
</div>
@endsection