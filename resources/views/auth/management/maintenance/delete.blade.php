@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="card-title">
                        Delete Job
                    </h3>
                    <div class="alert alert-warning">
                        <strong>Warning</strong>, you are about to delete a job. This action is irreversible. Please ensure you are deleting what you are intending to delete.
                    </div>
                    <form method="post" action="{{ route('job.delete.post') }}">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">ID</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $maintenanceJob->id }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Title</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $maintenanceJob->title }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $maintenanceJob->description }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8" style="padding-top: calc(.375rem + 1px); padding-bottom: calc(.375rem + 1px); margin-bottom: 0; font-size: inherit; line-height: 1.5;">
                                {!! $maintenanceJob->displayStatus() !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Submitted By</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ optional($maintenanceJob->submittedBy)->name() ?? "Management" }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <hr>
                            {{ csrf_field() }}
                            <input type="hidden" name="maintenance_job_id" value="{{ $maintenanceJob->id }}">
                            <a href="{{ route('job', $maintenanceJob) }}" class="btn btn-primary btn-outline-dark">Cancel</a>
                            <button type="submit" class="btn btn-danger pull-right">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection