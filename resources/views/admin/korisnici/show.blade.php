@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📂 Oglasi korisnika: {{ $user->ime }} {{ $user->prezime }}</h2>

    <p><strong>Email:</strong> {{ $user->email }}</p>
    <hr>

    @if($oglasi->count() > 0)
        <div class="row">
            @foreach($oglasi as $oglas)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($oglas->fotografije->count() > 0)
                            <img src="{{ asset($oglas->fotografije->first()->putanja) }}" 
                                 class="card-img-top" 
                                 alt="{{ $oglas->naslov }}">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" 
                                 class="card-img-top" 
                                 alt="Nema slike">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $oglas->naslov }}</h5>
                            <p class="card-text"><strong>Cena:</strong> {{ $oglas->cena }} €</p>
                            <p class="card-text"><strong>Lokacija:</strong> {{ $oglas->lokacija }}</p>
                            <a href="{{ route('oglasi.show', $oglas->id) }}" class="btn btn-primary btn-sm">Detaljnije</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $oglasi->links() }}
    @else
        <p>Korisnik još uvek nije postavio oglase.</p>
    @endif
</div>
@endsection
