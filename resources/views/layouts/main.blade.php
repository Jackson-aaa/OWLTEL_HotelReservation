<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Owltel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layouts/main.css') }}">
    <link rel="icon" type="image/ico?" href="{{ asset('favicon.ico') }}">

    @yield('cssStyles')
</head>

<body>
    <style>
        main{
            height: 100%;
            margin: 20px 10px 10px 20px;
        }
    </style>
    @if (!isset($hideNavbar) || !$hideNavbar)
        <header>
            @include('components.navbar')
        </header>
    @endif

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('jsScripts')
</body>

</html>