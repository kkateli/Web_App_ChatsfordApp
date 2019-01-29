@extends('layout.master')
@section('content')
<div class="main">
    @push('head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
    @endpush
    @include('layout.messages')
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-body addform">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Create Announcement</h3>
                    <form action="{{ route('announcements.add.post') }}" method="post">

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="There are 3 new residents to our village!" name="title">
                            @if($errors->has('title'))
                                <div class="error mt-1">
                                    <span class="fa fa-exclamation-circle"
                                          aria-hidden="true"></span> {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="body" placeholder="Please welcome them"></textarea>
                            @if($errors->has('body'))
                                <div class="error mt-1">
                                    <span class="fa fa-exclamation-circle"
                                          aria-hidden="true"></span> {{ $errors->first('body') }}
                                </div>
                            @endif
                        </div>

                        <h5>Post to</h5>

                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="postTo" value="allresidents" checked>All residents
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="postTo" value="homesAreas">Homes and/or areas
                                </label>
                            </div>
                        </div>

                        <div id="homesAreas" style="display: none;">
                            <div class="form-group">
                                <label>Areas</label>
                                <select class="form-control select2" name="areas[]" multiple="multiple">
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Homes</label>
                                <select class="form-control select2" name="homes[]" multiple="multiple">
                                    @foreach($homes as $home)
                                        <option value="{{ $home->id }}">{{ $home->address() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{ csrf_field() }}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-outline-dark">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // show select 2 boxes
            $('.select2').select2();

            $('input[type=radio]').on('change', function() {
                if (this.value == 'homesAreas') {
                    $("#homesAreas").fadeIn();
                    $('.select2').select2();
                } else {
                    $("#homesAreas select").each(function() {
                        $(this).val("")
                    });

                    $("#homesAreas").fadeOut();
                }
            })
        });
    </script>
@endpush
@endsection