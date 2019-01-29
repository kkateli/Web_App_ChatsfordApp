@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="card-title">
                        {{ $announcement->title }}
                    </h3>
                    <p class="card-text">
                        <strong>Status</strong><br>
                        {!! $announcement->showStatus() !!}
                    </p>
                    <p class="card-text">
                        <strong>Posted to</strong><br>
                        @if($announcement->postedToEveryone())
                            Everyone
                        @else
                            @foreach($announcement->postedTo() as $target)
                                @if ($target instanceof \App\Models\Home)
                                    {{ $target->address() }}@if(!$loop->last), @endif
                                @else
                                    {{ $target->name }}@if(!$loop->last), @endif
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <p class="card-text">
                        <strong>Announcement</strong><br>
                        {{ $announcement->body ?? "Not set" }}
                    </p>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">&nbsp;</h5>
                    <p class="card-text">
                        <strong>Created</strong><br>
                        {{ $announcement->created_at->diffForHumans() }}
                    </p>
                    <p class="card-text">
                        <strong>Last updated</strong><br>
                        {{ optional($announcement->updated_at)->diffForHumans() ?? "Not set" }}
                    </p>

                    <p class="card-text">
                        <strong>Actions</strong><br>
                        @if($announcement->isHidden())
                            <a class="edit" href="{{ route('announcements.reopen', $announcement) }}">
                                <i class="far fa-check-circle"></i>
                                Repost
                            </a>
                        @else
                            <a class="edit" href="{{ route('announcements.hide', $announcement) }}">
                                <i class="fas fa-minus-circle edit"></i>
                                Hide
                            </a>
                        @endif
                        <br>
                        <a href="{{ route('announcements.delete', $announcement) }}" class="edit">
                            <i class="far fa-trash-alt"></i>
                            Delete
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>Comments</h4>
            @forelse($comments as $comment)
                <div class="alert {{ $comment->user->id === auth()->id() ? "alert-success" : "alert-info" }}" style="display: inline-block;">
                    <b>{{ $comment->user->name() }}</b> {!! nl2br(e($comment->comment)) !!}
                </div>
                <br>
            @empty
                <p>There are no comments to show</p>
            @endforelse
            <form method="post" action="{{ route('announcements.add-comment.post')  }}" class="d-print-none">
                <div class="form-group">
                    <textarea class="form-control" name="comment" placeholder="Your comment"></textarea>
                    @if($errors->has('comment'))
                        <div class="error mt-1">
                            <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('comment') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="hidden" name="announcement_id" value="{{ $announcement->id }}">
                    {{ csrf_field() }}
                    <button class="btn btn-info btn-outline-dark">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection