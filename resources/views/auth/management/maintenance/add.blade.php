@extends('layout.master')
@section('content')
    <div class="main">
        @push('head')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
        @endpush
        @include('layout.messages')
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Submit new job request</h3>
                        <form action="{{ route('jobs.add.post') }}" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" placeholder="Title" name="title">
                                        @if($errors->has('title'))
                                            <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('title') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control select2" name="type">
                                            <option selected disabled="">--</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('type'))
                                            <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('type') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Resident</label>
                                        <select class="form-control" id="residents" name="resident_id"></select>
                                        @if($errors->has('resident_id'))
                                            <div class="error mt-1">
                                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('resident_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Home</label>
                                        <select class="form-control select2" name="home_id" id="home">
                                            <option></option>
                                            @foreach($homes as $home)
                                                <option value="{{ $home->id }}">{{ $home->address() }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('resident_id'))
                                            <div class="error mt-1">
                                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('resident_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Area</label>
                                        <select class="form-control" name="area_id" id="area">
                                            <option></option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('area_id'))
                                            <div class="error mt-1">
                                                <span class="fa fa-exclamation-circle" aria-hidden="true"></span> {{ $errors->first('area_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
                                @if($errors->has('description'))
                                    <div class="error mt-1">
                                        <span class="fa fa-exclamation-circle"
                                              aria-hidden="true"></span> {{ $errors->first('description') }}
                                    </div>
                                @endif
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
            $('#residents').select2({
                ajax: {
                    url: "{{ route('api.residents') }}"
                },
                placeholder: "--"
            });

            $("#area").select2({
                placeholder: "--"
            });

            $("#home").select2({
                placeholder: "--"
            });
        </script>
    @endpush
@endsection