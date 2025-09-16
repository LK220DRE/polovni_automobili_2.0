@extends('layouts.app')

@section('content')
<div class="container">
    <h2>➕ Dodaj marku</h2>
    <form action="{{ route('marke.store') }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <label>Naziv marke</label>
            <input type="text" name="naziv" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Sačuvaj</button>
    </form>
</div>
@endsection
