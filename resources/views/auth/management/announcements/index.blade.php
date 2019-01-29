@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="row">
            <div class="col-7">
                <h3 id="employeetitle">Announcements</h3>
                <a href="{{ route('announcements.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Add New</a>
            </div>
        </div>

        <table class="table table table-striped table-bordered">
            <thead>
                <th>Title</th>
                <th>Announcement</th>
                <th>Posted to</th>
                <th>Comments</th>
                <th>Status</th>
                <th class="text-center">View</th>
            </thead>
            <tbody>
            @forelse($announcements as $announcement)
                <tr>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ str_limit($announcement->body, 25) }}</td>
                    <td>
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
                    </td>
                    <td class="text-center">
                        {{ $announcement->comments_count }}
                    </td>
                    <td>{!! $announcement->showStatus() !!}</td>
                    <td class="text-center">
                        <a href="{{ route('announcements.view', $announcement) }}">
                            <i class="far fa-eye fa-lg eye view"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="6">There are no announcements to show</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $announcements->links() }}
    </div>
@endsection