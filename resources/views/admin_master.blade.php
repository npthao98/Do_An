<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ trans('header.admin') }}</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="{{ asset('bower_components/bower_admin/dist/css/adminlte_admin.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower_admin/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower_admin/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bower_admin/dist/css/dataTables.bootstrap4.min.css') }}">
    </head>

    <body class="hold-transition sidebar-mini">

            @include('includes.admin.header')

            @yield('content')

        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="{{ asset('bower_components/bower_admin/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('bower_components/bower_admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('bower_components/bower_admin/dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('bower_components/bower_admin/dist/js/demo.js') }}"></script>
        <!-- Page specific script -->
        <script src="{{ asset('js/dataTable.js') }}"></script>
        <script src="{{ asset('bower_components/bower_admin/dist/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('bower_components/bower_admin/dist/js/dataTables.bootstrap4.min.js') }}"></script>
    </body>

</html>
