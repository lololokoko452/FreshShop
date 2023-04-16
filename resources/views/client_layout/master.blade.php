<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Freshshop - @yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('frontend/images/apple-touch-icon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/sweetalert2/dist/sweetalert2.min.css') }}">
    @yield('styles')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    {{-- start header --}}
    @include('client_layout.header')
    {{-- end header --}}

    {{-- start content --}}
    @yield('content')
    {{-- end content --}}

    {{-- start header --}}
    @include('client_layout.footer')
    {{-- end header --}}
</body>
<script src="{{ asset('frontend/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
@if(Session::has("success"))
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            Swal.fire({
                title: '{{ Session::get("success") }}',
                icon: 'success',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
            });
        });
    </script>
@endif

@if(Session::has("error"))
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            Swal.fire({
                title: '{{ Session::get("error") }}',
                icon: 'warning',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
            });
        });
    </script>
@endif
@yield('scripts')
</html>

