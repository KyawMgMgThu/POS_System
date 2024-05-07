@if (Session::has('error'))
    <small class="bg-warning mb-0" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </small>
@endif
