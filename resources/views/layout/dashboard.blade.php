<!DOCTYPE html>
<html lang="fr_FR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <link href="{{ asset('vendor/bootstrap-5.0.0-alpha3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title', 'Dashboard')</title>
</head>

<body>
    @yield('content')

    <script src="{{ asset('vendor/bootstrap-5.0.0-alpha3-dist/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/fontawesome-free-5.14.0-web/js/all.min.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}" defer></script>
</body>

</html>
