@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Slike automobila -->
        <div class="col-md-6">
            @if($oglas->fotografije->count() > 0)
                <div id="carouselSlike" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($oglas->fotografije as $index => $slika)
                            <div class="carousel-item @if($index==0) active @endif">
                                <img src="{{ asset('storage/'.$slika->putanja) }}"
                                     class="d-block w-100 rounded"
                                     style="height:380px; object-fit:cover;"
                                     alt="{{ $oglas->naslov }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselSlike" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselSlike" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            @else
                <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded mb-3" style="max-height:300px;" alt="Nema slike">
            @endif
        </div>

        <!-- Detalji -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ $oglas->naslov }}</h2>
            <ul class="list-group mb-3 shadow-sm">
                <li class="list-group-item"><strong>Marka:</strong> {{ $oglas->marka }}</li>
                <li class="list-group-item"><strong>Model:</strong> {{ $oglas->model }}</li>
                <li class="list-group-item"><strong>Godište:</strong> {{ $oglas->godiste }}</li>
                <li class="list-group-item"><strong>Kilometraža:</strong> {{ number_format($oglas->kilometraza) }} km</li>
                <li class="list-group-item"><strong>Snaga motora:</strong> {{ $oglas->snaga_motora }} KS</li>
                <li class="list-group-item"><strong>Gorivo:</strong> {{ $oglas->tipGoriva->naziv ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Karoserija:</strong> {{ $oglas->karoserija->naziv ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Boja:</strong> {{ $oglas->boja }}</li>
                <li class="list-group-item"><strong>Lokacija:</strong> {{ $oglas->lokacija }}</li>
            </ul>

            <h4 class="text-success mb-3">Cena: {{ number_format($oglas->cena, 0, ',', '.') }} €</h4>
            <p><strong>Opis:</strong></p>
            <p>{{ $oglas->opis }}</p>

            <hr>
            <p><strong>Objavio:</strong> {{ $oglas->korisnik->ime }} {{ $oglas->korisnik->prezime }}</p>
            <p><strong>Email:</strong> {{ $oglas->korisnik->email }}</p>

            {{-- Admin opcije --}}
            @if(Auth::check() && Auth::user()->is_admin)
                <hr>
                <h5>Admin opcije</h5>
                <div class="mt-2">
                    <form action="/admin/oglasi/{{ $oglas->id }}/odobri" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">✅ Odobri</button>
                    </form>

                    <form action="/admin/oglasi/{{ $oglas->id }}/odbij" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">⚠️ Odbij</button>
                    </form>

                    <form action="{{ route('oglasi.destroy', $oglas) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">🗑️ Obriši</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
