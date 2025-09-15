@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🚘 Sve marke</h2>
    <a href="{{ route('marke.create') }}" class="btn btn-primary mb-3">Dodaj novu marku</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @foreach($marke as $marka)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $marka->naziv }}
                <form action="{{ route('marke.destroy', $marka) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Obriši</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
