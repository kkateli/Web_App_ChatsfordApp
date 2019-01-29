@extends('layout.master')
@section('content')
    @push('head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    @endpush
    <div class="main">
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <h3 class="card-title">
                    Register resident's interest for {{ $event->title }}
                </h3>
                <form method="post" action="{{ route('management.events.register-interest.post') }}">
                    <div class="form-group">
                        <label>Resident</label>
                        <select class="form-control" id="residents" name="resident_id"></select>
                        @if($errors->has('resident_id'))
                            <div class="error mt-1">
                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('resident_id') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ csrf_field() }}
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-primary btn-outline-dark">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
        <script>
            $('#residents').select2({
                ajax: {
                    url: "{{ route('api.residents') }}",
                }
            });
        </script>
    @endpush

@endsection