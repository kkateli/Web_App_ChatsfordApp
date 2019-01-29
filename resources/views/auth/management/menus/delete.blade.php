@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="card-title">
                        Delete Menu
                    </h3>
                    <div class="alert alert-warning">
                        <strong>Warning</strong>, you are about to delete a menu. This action is irreversible. Please ensure you are deleting what you are intending to delete.
                    </div>
                    <form method="post" action="{{ route('management.menu.delete.post') }}">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Time Period</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $menu->period() }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <hr>
                            {{ csrf_field() }}
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <a href="{{ route('management.menu.view', $menu) }}" class="btn btn-primary btn-outline-dark">Cancel</a>
                            <button type="submit" class="btn btn-danger pull-right">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection