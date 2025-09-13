@extends('layouts.app')
@section('content')
<h3>Postavljanje novog oglasa</h3>
<form method="POST" action="/oglasi" enctype="multipart/form-data">
  @csrf
  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif

  <div class="form-group">
    <label>Naslov oglasa</label>
    <input type="text" name="naslov" class="form-control" value="{{ old('naslov') }}" placeholder="npr. Škoda Octavia 2016" />
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Marka</label>
      <input type="text" name="marka" class="form-control" value="{{ old('marka') }}" required />
    </div>
    <div class="form-group col-md-6">
      <label>Model</label>
      <input type="text" name="model" class="form-control" value="{{ old('model') }}" required />
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Godište</label>
      <input type="number" name="godiste" class="form-control" value="{{ old('godiste') }}" required />
    </div>
    <div class="form-group col-md-4">
      <label>Cena (€)</label>
      <input type="number" name="cena" class="form-control" value="{{ old('cena') }}" required />
    </div>
    <div class="form-group col-md-4">
      <label>Kilometraža</label>
      <input type="number" name="kilometraza" class="form-control" value="{{ old('kilometraza') }}" required />
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Tip goriva</label>
      <select name="gorivo" class="form-control" required>
        <option value="">-- odaberite --</option>
        @foreach($tipoviGoriva as $tg)
          <option value="{{ $tg->id }}" @if(old('gorivo')==$tg->id) selected @endif>{{ $tg->naziv }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4">
      <label>Karoserija</label>
      <select name="karoserija" class="form-control" required>
        <option value="">-- odaberite --</option>
        @foreach($karoserije as $k)
          <option value="{{ $k->id }}" @if(old('karoserija')==$k->id) selected @endif>{{ $k->naziv }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4">
      <label>Snaga motora (KS)</label>
      <input type="number" name="snaga_motora" class="form-control" value="{{ old('snaga_motora') }}" required />
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Boja</label>
      <input type="text" name="boja" class="form-control" value="{{ old('boja') }}" required />
    </div>
    <div class="form-group col-md-6">
      <label>Lokacija (grad)</label>
      <input type="text" name="lokacija" class="form-control" value="{{ old('lokacija') }}" required />
    </div>
  </div>

  <div class="form-group">
    <label>Opis vozila</label>
    <textarea name="opis" class="form-control" rows="3" required>{{ old('opis') }}</textarea>
  </div>

  <div class="form-group">
    <label>Fotografije (možete odabrati više)</label>
    <input type="file" name="slike[]" class="form-control-file" multiple />
  </div>

  <button type="submit" class="btn btn-primary">Postavi oglas</button>
</form>
@endsection
