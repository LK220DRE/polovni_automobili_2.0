@extends('layouts.app')
@section('content')
<h3>Izmena oglasa</h3>
<form method="POST" action="/oglasi/{{ $oglas->id }}">
  @csrf
  @method('PUT')
  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Marka</label>
      <input type="text" name="marka" class="form-control" value="{{ old('marka', $oglas->marka) }}" required />
    </div>
    <div class="form-group col-md-6">
      <label>Model</label>
      <input type="text" name="model" class="form-control" value="{{ old('model', $oglas->model) }}" required />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Godište</label>
      <input type="number" name="godiste" class="form-control" value="{{ old('godiste', $oglas->godiste) }}" required />
    </div>
    <div class="form-group col-md-4">
      <label>Cena (€)</label>
      <input type="number" name="cena" class="form-control" value="{{ old('cena', $oglas->cena) }}" required />
    </div>
    <div class="form-group col-md-4">
      <label>Kilometraža</label>
      <input type="number" name="kilometraza" class="form-control" value="{{ old('kilometraza', $oglas->kilometraza) }}" required />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Tip goriva</label>
      <select name="gorivo" class="form-control" required>
        @foreach($tipoviGoriva as $tg)
          <option value="{{ $tg->id }}" @if(old('gorivo', $oglas->tip_goriva_id)==$tg->id) selected @endif>{{ $tg->naziv }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4">
      <label>Karoserija</label>
      <select name="karoserija" class="form-control" required>
        @foreach($karoserije as $k)
          <option value="{{ $k->id }}" @if(old('karoserija', $oglas->karoserija_id)==$k->id) selected @endif>{{ $k->naziv }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4">
      <label>Snaga motora (KS)</label>
      <input type="number" name="snaga_motora" class="form-control" value="{{ old('snaga_motora', $oglas->snaga_motora) }}" required />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Boja</label>
      <input type="text" name="boja" class="form-control" value="{{ old('boja', $oglas->boja) }}" required />
    </div>
    <div class="form-group col-md-6">
      <label>Lokacija</label>
      <input type="text" name="lokacija" class="form-control" value="{{ old('lokacija', $oglas->lokacija) }}" required />
    </div>
  </div>
  <div class="form-group">
    <label>Opis vozila</label>
    <textarea name="opis" class="form-control" rows="3" required>{{ old('opis', $oglas->opis) }}</textarea>
  </div>
  <!-- Napomena: dodavanje novih fotografija u izmeni nije implementirano -->
  <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
  <a href="/oglasi/{{ $oglas->id }}" class="btn btn-secondary">Otkaži</a>
</form>
@endsection
