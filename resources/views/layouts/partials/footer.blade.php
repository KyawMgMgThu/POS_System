<footer class="iq-footer">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="{{ route('privacy#privacy-policy') }}">Privacy
                                    Policy</a></li>
                            <li class="list-inline-item"><a href="{{ route('terms-of-service') }}">Terms of
                                    Use</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="mr-1">
                            <script>
                                document.write(new Date().getFullYear())
                            </script>©
                        </span> <a href="https://www.facebook.com/profile.php?id=100057101206481&mibextid=ZbWKwL"
                            class="">@yield('title', config('app.name'))</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
