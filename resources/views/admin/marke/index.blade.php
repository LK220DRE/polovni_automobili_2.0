@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upravljanje markama</h2>

    <!-- Dodavanje nove marke -->
    <form method="POST" action="{{ route('marke.store') }}" class="mb-3">
        @csrf
        <input type="text" name="naziv" class="form-control d-inline w-50" placeholder="Unesi naziv marke">
        <button type="submit" class="btn btn-success">Dodaj</button>
    </form>

    <!-- Prikaz svih marki -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marke as $marka)
                <tr>
                    <td>{{ $marka->id }}</td>
                    <td>{{ $marka->naziv }}</td>
                    <td>
                        <form action="{{ route('marke.destroy', $marka->id) }}" method="POST" onsubmit="return confirm('Da li si siguran da želiš da obrišeš ovu marku?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
