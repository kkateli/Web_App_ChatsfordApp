@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <h3>Maintenance Overview</h3>
    <p></p>
    <table class="table table-bordered dashboard">
        <tbody>
            @foreach($maintenanceTypes->chunk(4) as $maintenanceTypeGroup)
                <tr>
                    @foreach($maintenanceTypeGroup as $maintenanceType)
                        <td class="maintdashtable">
                            <a href="{{ route('maintenance.jobs', ['type' => $maintenanceType->id]) }}">
                                <i class="{{ $maintenanceType->icon_type }} fa-4x dashicon"></i>
                                <p class="resdashnumbers">{{ $maintenanceType->maintenance_jobs_count }}</p>
                                <p class="dashnames">{{ $maintenanceType->name }}</p>
                            </a>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
