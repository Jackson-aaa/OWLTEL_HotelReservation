<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title', 'Owltel')</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layouts/main.css') }}">
    <link rel="icon" type="image/ico?" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{asset('iconpicker/assets/stylesheets/universal-icon-picker.min.css')}}">
    <script src="{{asset('iconpicker/assets/js/universal-icon-picker.min.js')}}"></script>
    @yield('cssStyles')
</head>

<body>
    @if (!isset($hideNavbarandFooter) || !$hideNavbarandFooter)
        <header>
            @include('components.navbar')
        </header>
    @endif

    <main>
        @yield('content')
    </main>

    @if (!isset($hideNavbarandFooter) || !$hideNavbarandFooter)
        @include('components.footer')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('jsScripts')
</body>

</html>
