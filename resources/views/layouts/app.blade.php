<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="shkkireal">
    <meta name="generator" content="shkkireal">
    <title>SmartHome</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this template -->

    </head>


            @yield('content')


<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/jquery-3.6.0.js"></script>

@yield('custom_js')
</body>


</html>
