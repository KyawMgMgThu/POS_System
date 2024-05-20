<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('navtitle', config('app.name'))</title>

    <!-- Favicon -->
    <link rel="stylesheet" href="../../../assets/css/intro.css">
    <link rel="shortcut icon" href="../../../assets/images/logo.png" />
    <link rel="stylesheet" href="../../../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../../../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../../../assets/vendor/remixicon/fonts/remixicon.css">
    @vite(['resources/js/components/Cart.jsx'])
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        @include('layouts.partials.sidebar')
        @include('layouts.partials.alert.success')
        @include('layouts.partials.alert.error')
        @include('layouts.partials.navbar')

        @yield('content')

    </div>
    <!-- Wrapper End-->
    @include('layouts.partials.footer')
    <!-- Backend Bundle JavaScript -->
    <script src="../../../assets/js/backend-bundle.min.js"></script>

    <!-- app JavaScript -->
    <script src="../../../assets/js/app.js"></script>

    @yield('js')
</body>
<script>
    window.APP = <?php echo json_encode([
        'currency' => config('settings.currency_symbol'),
    ]); ?>
</script>

</html>
