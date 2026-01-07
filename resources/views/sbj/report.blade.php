<!DOCTYPE html>
<html lang="en">

<head>
    @include('sbj.styles')
    @stack('styles')
</head>
<body class="sidebar-mini text-sm">

    <div class="content">
            @yield('content')
    </div>

    @include('sbj.scripts')
    @stack('scripts')

</body>

</html>