@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="card-title">
                        Delete Complaint
                    </h3>
                    <div class="alert alert-warning">
                        <strong>Warning</strong>, you are about to delete a complaint. This action is irreversible. Please ensure you are deleting what you are intending to delete.
                    </div>
                    <form method="post" action="{{ route('complaint.delete.post') }}">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Complaint</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $complaint->description }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8" style="padding-top: calc(.375rem + 1px); padding-bottom: calc(.375rem + 1px); margin-bottom: 0; font-size: inherit; line-height: 1.5;">
                                {!! $complaint->displayStatus() !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Submitted By</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $complaint->submittedBy->name() }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <hr>
                            {{ csrf_field() }}
                            <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                            <a href="{{ route('management.complaints', $complaint) }}" class="btn btn-primary btn-outline-dark">Cancel</a>
                            <button type="submit" class="btn btn-danger pull-right">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection