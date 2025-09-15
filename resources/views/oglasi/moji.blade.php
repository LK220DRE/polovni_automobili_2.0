@extends('layouts.app')
@section('content')
<h3>Moji oglasi</h3>
@if($oglasi->count() == 0)
    <p>Nemate još postavljenih oglasa.</p>
@else
<div class="row">
    @foreach($oglasi as $oglas)
        <div class="col-md-4 mb-3">
            <div class="card">
                @if($oglas->fotografije->count() > 0)
                    <img src="{{ asset($oglas->fotografije->first()->putanja) }}" class="card-img-top" alt="Slika oglasa">
                @else
                    <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="Nema slike">
                @endif
                <div class="card-body">
                    <h5>{{ $oglas->naslov }}</h5>
                    <p>{{ $oglas->cena }} €</p>
                    <a href="{{ route('oglasi.show', $oglas) }}" class="btn btn-primary btn-sm">Detalji</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $oglasi->links() }}
@endif
@endsection
