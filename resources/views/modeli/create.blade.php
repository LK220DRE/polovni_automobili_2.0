@extends('layouts.app')

@section('content')
<div class="container">
    <h2>➕ Dodaj model</h2>
    <form action="{{ route('modeli.store') }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <label>Naziv modela</label>
            <input type="text" name="naziv" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Marka</label>
            <select name="marka_id" class="form-control" required>
                @foreach($marke as $marka)
                    <option value="{{ $marka->id }}">{{ $marka->naziv }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Sačuvaj</button>
    </form>
</div>
@endsection
