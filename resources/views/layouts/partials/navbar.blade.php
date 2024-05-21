<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                <i class="ri-menu-line wrapper-menu"></i>
                <a href="{{ route('home') }}" class="">
                    <img src="../../../assets/images/logo.png" class="img-fluid rounded-normal" width="50"
                        height="50" alt="logo">
                    <h5 class="logo-title ml-3">@yield('title', config('app.name'))</h5>

                </a>
            </div>
            <div class="">

            </div>
            <div class="d-flex align-items-end">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list align-items-center">
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
