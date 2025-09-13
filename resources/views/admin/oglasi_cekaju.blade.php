@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Oglasi koji čekaju odobrenje</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($oglasi->count() == 0)
        <p class="text-muted">Trenutno nema oglasa na čekanju.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Naslov</th>
                    <th>Marka</th>
                    <th>Model</th>
                    <th>Korisnik</th>
                    <th>Cena (€)</th>
                    <th>Datum kreiranja</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach($oglasi as $oglas)
                    <tr>
                        <td>{{ $oglas->id }}</td>
                        <td>{{ $oglas->naslov }}</td>
                        <td>{{ $oglas->marka }}</td>
                        <td>{{ $oglas->model }}</td>
                        <td>{{ $oglas->korisnik->ime }} {{ $oglas->korisnik->prezime }}</td>
                        <td>{{ number_format($oglas->cena, 0, ',', '.') }}</td>
                        <td>{{ $oglas->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <form action="/admin/oglasi/{{ $oglas->id }}/odobri" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">✅ Odobri</button>
                            </form>
                            <form action="/admin/oglasi/{{ $oglas->id }}/odbij" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">⚠️ Odbij</button>
                            </form>
                            <a href="{{ route('oglasi.show', $oglas->id) }}" class="btn btn-info btn-sm">🔎 Detalji</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $oglasi->links() }}
    @endif
</div>
@endsection
