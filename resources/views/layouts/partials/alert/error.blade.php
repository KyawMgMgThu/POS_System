@if (Session::has('error'))
    <div class="alert alert-primary" role="alert">
        {{ Session::get('error') }}
    </div>
@endif
