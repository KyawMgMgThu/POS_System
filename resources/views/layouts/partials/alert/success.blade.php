@if (Session::has('success'))
    <div class="iq-footer alert alert-warning alert-dismissible fade show mt-5" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
