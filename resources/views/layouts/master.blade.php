<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ENV('APP_NAME') }} | @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @include('layouts.partial.nav')
    @include('layouts.partial.aside')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div><!-- /.container-fluid -->
        </div>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('js/datepicker/moment.min.js') }}"></script>
<script src="{{ asset('js/datepicker/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('js/datepicker/ja.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/select2/select2.min.js') }}"></script>

@stack('scripts')

</html>
