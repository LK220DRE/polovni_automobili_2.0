@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-4">
    <h3>Prijava na sistem</h3>
    <form method="POST" action="/login">
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
        <label for="email">Email adresa</label>
        <input type="email" name="email" class="form-control" required />
      </div>
      <div class="form-group">
        <label for="password">Lozinka</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-primary btn-block">Prijavi se</button>
      <p class="mt-2">Nemate nalog? <a href="/register">Registrujte se</a>.</p>
    </form>
  </div>
</div>
@endsection
