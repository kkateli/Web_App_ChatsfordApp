@extends('layout.master')
@section('content')
<div class="main">
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="card-title">
                        {{ $event->title }}
                    </h3>
                    <p class="card-text"><strong>Description:</strong> {{ $event->description }}</p>
                    <p class="card-text"><strong>Time:</strong> {{ $event->getTime() }}</p>
                    <p class="card-text"><strong>Cost:</strong> {{ $event->cost ? "$" . $event->cost : "Not set" }}</p>
                    @if ($event->location)
                        <p class="card-text"><strong>Location:</strong> {{ $event->location}}</p>
                    @endif
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">&nbsp;</h5>
                    <p class="card-text"><strong>Actions</strong><br>
                        <a class="edit" href="{{ route('event.edit', $event) }}"><i class="far fa-edit eye edit"></i> Edit</a><br>
                        <a class="edit" href="{{ route('management.events.register-interest', $event) }}"><i class="far fa-check-circle"></i> Register resident's interest</a>
                        <br>
                        <a href="{{ route('event.delete', $event) }}" class="edit">
                            <i class="far fa-trash-alt"></i>
                            Delete
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <h4>Interested residents</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <th>Name</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @forelse($interestedUsers as $resident)
                <tr>
                    <td>{{ $resident->name() }}</td>
                    <td width="300" class="text-center">
                        <form action="{{ route('management.events.deregister-interest.post') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="resident_id" value="{{ $resident->id }}">
                            <button type="submit" class="btn btn-link register"><i class="fas fa-ban"></i> Cancel resident's interest</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="2">There are currently no residents interested in this event</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $interestedUsers->links() }}
    </div>
</div>
@endsection