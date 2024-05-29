<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.webp')}}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- Scripts -->
    @vite([])


    <style>
        .help-block{
            color:red !important;
        }

        [class*=sidebar-light-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-light-] .nav-sidebar>.nav-item:hover>.nav-link {
            background-color: rgb(102 97 255 / 80%);
            color: #fff;
        }
        .dropdown-item.active, .dropdown-item:active {
            color: #fff !important;
            text-decoration: none;
            background-color: rgb(102 97 255 / 80%);
        }
        .link-pro{
            color: #6661FFCC !important;
        }
        .dropdown-item:focus, .dropdown-item:hover {
            color: #fff !important;
            text-decoration: none;
            background-color: #8581ff !important;
        }
        .dropdown-item:focus input, .dropdown-item:hover input {
            color: #fff !important;
            text-decoration: none;
            background-color: #8581ff !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice, .btn-pro {
            color: #fff;
            background-color: #8581ff !important;
            border-color: #6661FFCC !important;
            box-shadow: none;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[aria-selected]:hover,
        .btn-pro:hover {
            color: #fff;
            background-color: #6661FFCC !important;
            border-color: #8581ff !important;
        }
        .btn-pro.focus, .btn-pro:focus {
            color: #fff;
            background-color: #8581ff !important;
            border-color: #6661FFCC !important;
            box-shadow: 0 0 0 0 rgb(102 97 255 / 90%);
        }
        .badge-pro {
            color: #fff;
            background-color: #8581ff;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


    @include('partials.menu')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2024 <a href="#">Emerj Pro</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('.select-all').click(function() {
            $('#permissions option').prop('selected', true);
            $('#permissions').trigger('change'); // Ensure change event is fired
        });

        $('.deselect-all').click(function() {
            $('#permissions option').prop('selected', false);
            $('#permissions').trigger('change'); // Ensure change event is fired
        });
    });
</script>
</body>
</html>
