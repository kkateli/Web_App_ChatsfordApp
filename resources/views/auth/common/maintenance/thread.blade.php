<div class="card" style="margin-bottom: 25px;">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h5 class="card-title">
                    Job #{{ $job->id }}
                </h5>
                <p class="card-text"><strong>Status</strong><br> {!! $job->displayStatus()  !!}</p>
                <p class="card-text"><strong>Submitted by</strong><br> {{ optional($job->submittedBy)->name() ?? "Entered by management" }}</p>
                <p class="card-text">
                    <strong>Address</strong><br>
                    {{ $job->getAddress() }}
                </p>
                <p class="card-text"><strong>Description</strong><br> {{ $job->description }}</p>
            </div>
            <div class="col">
                <h5 class="card-title">&nbsp;</h5>
                <p class="card-text">
                    <strong>Type</strong><br>
                    {{ optional($job->maintenance_type)->name ?? "Not set" }}
                </p>
                <p class="card-text"><strong>Submitted</strong> {{ $job->created_at->diffForHumans() }}</p>
                <p class="card-text"><strong>Last updated</strong> {{ optional($job->updated_at)->diffForHumans() ?? "--"}}</p>

                @if (auth()->user()->isMaintenance() || auth()->user()->isManagement())
                    <p class="card-text d-print-none"><strong>Actions</strong><br>
                        @if(! $job->inProgress() && ! $job->isComplete())
                            <a class="inprog" href="{{ route('job.update.in-progress', $job) }}">
                                <i class="fas fa-toolbox"></i>
                                Mark in progress
                            </a>
                            <br>
                        @endif

                        @if(!$job->isComplete())
                            <a class="complete" href="{{ route('job.update.completed', $job) }}">
                                <i class="far fa-times-circle"></i>
                                Complete job
                            </a>
                        @else
                            <a class="reopen" href="{{ route('job.update.reopen', $job) }}">
                                <i class="far fa-check-circle"></i>
                                Reopen job
                            </a>
                        @endif
                        <br>
                        <a class="print" href="javascript:window.print()">
                            <i class="fas fa-print"></i>
                            Print
                        </a>
                        @if(auth()->user()->isManagement())
                            <br>
                            <a href="{{ route('job.delete', $job) }}" class="edit">
                                <i class="far fa-trash-alt"></i>
                                Delete
                            </a>
                        @endif
                    </p>
                @endif
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

@if(! auth()->user()->isResident())
    <hr>
    @if (! $job->isComplete())
        <form method="post" action="{{ auth()->user()->getUrlForAddingCorrespondence() }}" class="d-print-none">
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
                <input type="hidden" name="job_id" value="{{ $job->id }}">
                <button class="btn btn-info btn-outline-dark">Submit</button>
            </div>
        </form>
    @else
        <p class="text-center">
            Reopen job to comment on it.
        </p>
    @endif
@endif