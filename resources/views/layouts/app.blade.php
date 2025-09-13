<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polovni Automobili</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">🚗 Polovni automobili</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Leva strana -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Početna</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/oglasi/create') }}">Postavi oglas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/onama') }}">O nama</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/privatnost') }}">Privatnost</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/kontakt') }}">Kontakt</a></li>

                @if(Auth::check() && Auth::user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('admin.oglasi.cekaju') }}">📑 Oglasi za proveru</a>
                    </li>
                @endif
            </ul>

            <!-- Desna strana -->
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Prijava</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registracija</a></li>
                @else
                    <li class="nav-item">
                        <span class="navbar-text text-light">
                            👤 {{ Auth::user()->ime }} {{ Auth::user()->prezime }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Odjava</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
