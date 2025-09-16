@extends('layouts.app')

@section('content')
<div class="container">
    <h2>👥 Lista korisnika</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ime i Prezime</th>
                <th>Email</th>
                <th>Broj oglasa</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach($korisnici as $korisnik)
                <tr>
                    <td>{{ $korisnik->id }}</td>
                    <td>{{ $korisnik->ime }} {{ $korisnik->prezime }}</td>
                    <td>{{ $korisnik->email }}</td>
                    <td>{{ $korisnik->oglasi_count }}</td>
                    <td>
                        <a href="{{ route('admin.korisnici.show', $korisnik) }}" class="btn btn-info btn-sm">📄 Pregled</a>

                        @if(Auth::id() !== $korisnik->id) 
                        <form action="{{ route('admin.korisnici.destroy', $korisnik) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Da li ste sigurni da želite obrisati ovog korisnika?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Obriši</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $korisnici->links() }}
</div>
@endsection
