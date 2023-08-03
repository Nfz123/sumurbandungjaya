    <script src="{{ URL::asset('assets/dist/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/plugins/toastr/toastr.min.js') }}"></script>
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
