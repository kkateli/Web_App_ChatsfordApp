@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        @include('auth.common.maintenance.thread')
    </div>
@endsection