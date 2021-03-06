<!DOCTYPE html>
<html lang="fr_FR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="@yield('description', "Le blog de l'Everest")">
    <link href="{{ asset('vendor/bootstrap-5.0.0-alpha3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title', "Le blog de l'Everest")</title>
</head>

<body>
    <header class="d-flex flex-column align-items-center text-white">
        <h1 class="display-3 mb-4">Le blog de l'Everest</h1>
        <h3>Mountain, Snow, Mountaineering, Everest</h3>
    </header>

    @yield('content')

    <footer class="d-flex flex-column align-items-center text-white">
        <h1 class="display-3 mb-4">Le blog de l'Everest</h1>

        <ul class="social-icons">
            <a href="#" class="text-white">
                <i class="fab fa-facebook-square"></i>
            </a>

            <a href="#" class="text-white mx-3">
                <i class="fab fa-instagram"></i>
            </a>

            <a href="#" class="text-white mr-3">
                <i class="fab fa-pinterest-square"></i>
            </a>
            
            <a href="#" class="text-white">
                <i class="fab fa-youtube"></i>
            </a>
        </ul>
    </footer>

    <script src="{{ asset('vendor/bootstrap-5.0.0-alpha3-dist/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/fontawesome-free-5.14.0-web/js/all.min.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}" defer></script>
</body>

</html>
