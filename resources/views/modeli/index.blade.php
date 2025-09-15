@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🛠️ Svi modeli</h2>
    <a href="{{ route('modeli.create') }}" class="btn btn-primary mb-3">Dodaj novi model</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @foreach($modeli as $model)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $model->naziv }} <span class="text-muted">({{ $model->marka->naziv }})</span>
                <form action="{{ route('modeli.destroy', $model) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Obriši</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
