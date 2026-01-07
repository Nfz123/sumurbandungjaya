<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi SBJ Ekspedisi</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ URL::asset('assets/dist/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/plugins/toastr/toastr.min.css') }}">

</head>

<body class="login-page" style="min-height: 466px;">
    <div class="login-box">

        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>S</b>BJ<a>Ekspedisi</a></a>
            </div>
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('assets/dist/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('css/style.css') }}"></script>
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>

</body>

</html>
