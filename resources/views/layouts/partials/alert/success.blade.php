@if (Session::has('success'))
    <small class="bg-success mb-0" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </small>
@endif
