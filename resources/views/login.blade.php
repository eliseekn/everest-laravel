<!DOCTYPE html>
<html lang="fr_FR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Log in to dashboard">
    <link href="{{ asset('vendor/bootstrap-5.0.0-alpha3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Log in</title>
</head>

<body>
    <div class="container py-5" style="width: 450px">
        <h1 class="pb-4 text-center">Log in</h1>

        @if ($message = Session::pull('error'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif

        <div class="card shadow p-4">
            <form action="{{ url('login') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" value="{{ old('email') ?? '' }}" name="email" id="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button class="btn btn-dark" type="submit">Log in</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap-5.0.0-alpha3-dist/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/fontawesome-free-5.14.0-web/js/all.min.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}" defer></script>
</body>

</html>
