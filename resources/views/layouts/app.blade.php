<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polovni Automobili</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* 🌈 Gradient navbar */
        .navbar {
            background: linear-gradient(90deg, #0066ff, #003399);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.2rem;
        }
        .nav-link {
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #ffdd57 !important;
        }
        .navbar-text {
            margin-right: 15px;
        }
        .btn-link.nav-link {
            color: #ff4d4d !important;
            font-weight: bold;
        }
        .btn-link.nav-link:hover {
            color: #ff1a1a !important;
            text-decoration: none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
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

                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('oglasi.moji') }}">Moji oglasi</a></li>
                    @if(Auth::user()->is_admin)
                        <li class="nav-item"><a class="nav-link" href="{{ url('/admin/oglasi') }}">📑 Oglasi za proveru</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.korisnici.index') }}">👥 Korisnici</a></li>
                    @endif
                @endauth

                <li class="nav-item"><a class="nav-link" href="{{ url('/onama') }}">O nama</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/privatnost') }}">Privatnost</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/kontakt') }}">Kontakt</a></li>
            </ul>

            <!-- Desna strana -->
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Prijava</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registracija</a></li>
                @else
                    <li class="nav-item">
                        <span class="navbar-text text-light fw-bold">
                            👤 {{ Auth::user()->ime }} {{ Auth::user()->prezime }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">🚪 Odjava</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
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
