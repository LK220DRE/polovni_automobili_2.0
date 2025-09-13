@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3>Registracija korisnika</h3>
    <form method="POST" action="/register">
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
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="ime">Ime</label>
          <input type="text" name="ime" class="form-control" value="{{ old('ime') }}" required />
        </div>
        <div class="form-group col-md-6">
          <label for="prezime">Prezime</label>
          <input type="text" name="prezime" class="form-control" value="{{ old('prezime') }}" required />
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required />
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="password">Lozinka</label>
          <input type="password" name="password" class="form-control" required />
        </div>
        <div class="form-group col-md-6">
          <label for="password_confirmation">Potvrda lozinke</label>
          <input type="password" name="password_confirmation" class="form-control" required />
        </div>
      </div>
      <button type="submit" class="btn btn-success btn-block">Registruj se</button>
      <p class="mt-2">Već imate nalog? <a href="/login">Prijavite se</a>.</p>
    </form>
  </div>
</div>
@endsection
