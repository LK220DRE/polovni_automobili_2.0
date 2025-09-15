@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">👥 Lista korisnika</h2>

    @if($korisnici->count() > 0)
        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Email</th>
                    <th>Broj oglasa</th>
                    <th>Registrovan</th>
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
                @foreach($korisnici as $korisnik)
                    <tr>
                        <td>{{ $korisnik->id }}</td>
                        <td>{{ $korisnik->ime }} {{ $korisnik->prezime }}</td>
                        <td>{{ $korisnik->email }}</td>
                        <td>{{ $korisnik->oglasi_count }}</td>
                        <td>{{ $korisnik->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.korisnici.show', $korisnik->id) }}" 
                               class="btn btn-primary btn-sm">📂 Pogledaj oglase</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $korisnici->links() }}
    @else
        <p>Nema registrovanih korisnika.</p>
    @endif
</div>
@endsection
