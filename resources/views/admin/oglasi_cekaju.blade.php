@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>📑 Oglasi koji čekaju odobrenje</h3>
    @if($oglasi->count() == 0)
        <p>Trenutno nema oglasa na čekanju.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naslov</th>
                    <th>Korisnik</th>
                    <th>Datum</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach($oglasi as $oglas)
                    <tr>
                        <td>{{ $oglas->id }}</td>
                        <td>{{ $oglas->naslov }}</td>
                        <td>{{ $oglas->korisnik->ime }} {{ $oglas->korisnik->prezime }}</td>
                        <td>{{ $oglas->created_at->format('d.m.Y') }}</td>
                        <td>
                            <form action="/admin/oglasi/{{ $oglas->id }}/odobri" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Odobri</button>
                            </form>
                            <form action="/admin/oglasi/{{ $oglas->id }}/odbij" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-warning btn-sm">Odbij</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $oglasi->links() }}
    @endif
</div>
@endsection
