@extends('layouts.app')
@section('content')
<h3 class="mb-3">Pretraga oglasa</h3>

<div class="card shadow-sm p-3 mb-4">
<form method="GET" action="/">
  <div class="form-row">
    <div class="form-group col-md-3">
      <label>Marka</label>
      <input type="text" name="marka" class="form-control" value="{{ request('marka') }}" />
    </div>
    <div class="form-group col-md-3">
      <label>Model</label>
      <input type="text" name="model" class="form-control" value="{{ request('model') }}" />
    </div>
    <div class="form-group col-md-2">
      <label>Godište od</label>
      <input type="number" name="godiste_od" class="form-control" value="{{ request('godiste_od') }}" />
    </div>
    <div class="form-group col-md-2">
      <label>Godište do</label>
      <input type="number" name="godiste_do" class="form-control" value="{{ request('godiste_do') }}" />
    </div>
    <div class="form-group col-md-2">
      <label>Gorivo</label>
      <select name="gorivo" class="form-control">
        <option value="">Bilo koje</option>
        @foreach($tipoviGoriva as $tg)
          <option value="{{ $tg->id }}" @if(request('gorivo')==$tg->id) selected @endif>{{ $tg->naziv }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-2">
      <label>Cena od (€)</label>
      <input type="number" name="cena_od" class="form-control" value="{{ request('cena_od') }}" />
    </div>
    <div class="form-group col-md-2">
      <label>Cena do (€)</label>
      <input type="number" name="cena_do" class="form-control" value="{{ request('cena_do') }}" />
    </div>
    <div class="form-group col-md-3">
      <label>Karoserija</label>
      <select name="karoserija" class="form-control">
        <option value="">Bilo koja</option>
        @foreach($karoserije as $k)
          <option value="{{ $k->id }}" @if(request('karoserija')==$k->id) selected @endif>{{ $k->naziv }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-3">
      <label>Lokacija</label>
      <input type="text" name="lokacija" class="form-control" value="{{ request('lokacija') }}" />
    </div>
    <div class="form-group col-md-2">
      <label>Sortiraj po ceni</label>
      <select name="sort" class="form-control">
        <option value="">Najnovije</option>
        <option value="cena_asc" @if(request('sort')=='cena_asc') selected @endif>Cena rastuće</option>
        <option value="cena_desc" @if(request('sort')=='cena_desc') selected @endif>Cena opadajuće</option>
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">🔎 Pretraži</button>
</form>
</div>

@if($oglasi->count() == 0)
  <p>Nema oglasa za prikaz.</p>
@else
  <div class="row">
    @foreach($oglasi as $oglas)
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          @if($oglas->fotografije->count() > 0)
            <img src="{{ asset($oglas->fotografije->first()->putanja) }}" class="card-img-top" alt="{{ $oglas->naslov }}">
          @else
            <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="Nema slike">
          @endif

          <div class="card-body">
            <h5 class="card-title">{{ $oglas->naslov }}</h5>
            <p class="card-text"><strong>Cena:</strong> {{ $oglas->cena }} €</p>
            <p class="card-text"><strong>Lokacija:</strong> {{ $oglas->lokacija }}</p>
            <p class="card-text"><strong>kilometraza:</strong> {{ $oglas->kilometraza }}</p>
            <a href="{{ route('oglasi.show', $oglas->id) }}" class="btn btn-primary btn-sm">Detaljnije</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  {{ $oglasi->links() }}
@endif
@endsection
