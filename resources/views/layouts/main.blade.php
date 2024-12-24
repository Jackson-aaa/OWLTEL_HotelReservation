<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title', 'Owltel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layouts/main.css') }}">
    <link rel="icon" type="image/ico?" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{asset('iconpicker/assets/stylesheets/universal-icon-picker.min.css')}}">
    <script src="{{asset('iconpicker/assets/js/universal-icon-picker.min.js')}}"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    
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