@if (session()->has('error'))
    <div class="alert alert-warning">
        {{ session()->get('error') }}
    </div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success mb-3">
        {{ session()->get('success') }}
    </div>
@endif