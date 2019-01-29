<div class="card" style="margin-bottom: 25px;">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h5 class="card-title">
                    Complaint #{{ $complaint->id }}
                </h5>
                <p class="card-text"><strong>Status</strong><br> {!! $complaint->displayStatus()  !!}</p>
                <p class="card-text"><strong>Submitted by</strong><br> {{ $complaint->submittedBy->name() }}</p>
                <p class="card-text"><strong>Description</strong><br> {{ $complaint->description }}</p>
            </div>
            <div class="col">
                <h5 class="card-title">&nbsp;</h5>
                <p class="card-text"><strong>Submitted</strong> {{ $complaint->created_at->diffForHumans() }}</p>
                <p class="card-text"><strong>Last updated</strong> {{ optional($complaint->updated_at)->diffForHumans() ?? "--"}}</p>



                <p class="card-text"><strong>Actions</strong><br>
                    @if(! $complaint->isResolved())
                        <a class="complaint" href="{{ route('common.complaints.resolve', $complaint) }}">
                            <i class="fas fa-toolbox complaint"></i>
                            Mark as resolved
                        </a>
                    @endif
                    @if($complaint->isResolved())
                        <br>
                        <a class="complaint" href="{{ route('common.complaints.reopen', $complaint) }}">
                            <i class="fas fa-toolbox complaint"></i>
                            Re-open
                        </a>
                    @endif
                    @if(auth()->user()->isManagement())
                        <br>
                        <a href="{{ route('complaint.delete', $complaint) }}" class="edit">
                            <i class="far fa-trash-alt"></i>
                            Delete
                        </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

<h4>Correspondence</h4>
@if($correspondence->count() == 0)
    <p>
        There are no replies to show.
    </p>
@else
    <div class="row">
        @foreach($correspondence as $entry)
            @if($entry->notYou() && $entry->isComment())
                <div class="col-lg-12">
                    <div class="pull-left">
                        <div class="alert alert-success reply">
                            <span><strong>{{ $entry->user->name() }}</strong><small> - {{ $entry->created_at->diffForHumans() }}</small></span>
                            <p>{{ $entry->comment }}</p>
                        </div>
                    </div>
                </div>
            @elseif($entry->isEvent())
                <div class="col-lg-12">
                    <div class="text-center">
                        <p>
                            <i class="far fa-calendar-alt"></i>
                            Job was {{ $entry->event() }} by {{ $entry->by() }} {{ $entry->when() }}
                        </p>
                    </div>
                </div>
            @else
                <div class="col-lg-6 offset-md-6">
                    <div class="pull-right">
                        <div class="alert alert-info reply">
                            <span><strong>You</strong><small> - {{ $entry->created_at->diffForHumans() }}</small></span>
                            <p>{!! nl2br(e($entry->comment)) !!}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="clearfix"></div>
        @endforeach
    </div>
@endif

@if(! $complaint->isResolved())
    <form method="post" action="{{ route('common.complaints.add-correspondence') }}">
        <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" name="message"></textarea>
            @if($errors->has('message'))
                <div class="error mt-1">
                    <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('message') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            {{ csrf_field() }}
            <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
            <button class="btn btn-info btn-fill btn-primary btn-sm btn-outline-dark">Submit</button>
        </div>
    </form>
@else
    <p class="text-center">
        Reopen complaint to comment on it.
    </p>
@endif