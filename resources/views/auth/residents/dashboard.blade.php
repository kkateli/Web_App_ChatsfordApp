@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <h3>Announcements</h3>
        @if($announcements->count() === 0)
            <p>There are currently no announcements to show</p>
        @else
            @foreach($announcements->chunk(3) as $announcementChunk)
                <div class="card-columns">

                @foreach($announcementChunk as $announcement)
                    <div class="card">
                        <div class="card-body">
                            <a class="announce" href="{{ route('residents.announcements.view', $announcement) }}">
                                <h5 class="card-title">{{ $announcement->title }}</h5></a>
                            <p class="card-text">{{ $announcement->body }}</p>

                            <a class="card-text" href="{{ route('residents.announcements.view', $announcement) }}">
                                <small class="text-muted comments">Comments ({{ $announcement->comments_count }})</small>
                            </a>

                            <p class="card-text">
                                <small class="text-muted">Posted {{ $announcement->created_at->diffForHumans() }} to {{ $announcement->getTo() }}</small>
                            </p>
                        </div>
                    </div>
                @endforeach
                </div>
            @endforeach
        @endif
    </div>
@endsection
