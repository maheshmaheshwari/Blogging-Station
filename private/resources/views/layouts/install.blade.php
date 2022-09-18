<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background: #d2d6de;
        }

        .install {
            overflow: hidden;
            background: #fff;
            width: 100%;
            max-width: 500px;
            padding: 15px;
            margin: auto;
        }
    </style>
</head>
<body>

<div class="install">
    @include('_partials.flash_message')

    <h3 class="text-center mb-3">@yield('title')</h3>

    @yield('content')
</div>

</body>
</html>
