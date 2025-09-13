@extends('layouts.app')
@section('content')
<h3>Admin panel - Moderacija oglasa</h3>
<h5 class="mt-4">Oglasi na čekanju ({{ $pendingOglasi->count() }})</h5>
@if($pendingOglasi->isEmpty())
  <p>Nema oglasa na čekanju.</p>
@else
  <table class="table table-bordered"><img src="{{ asset('storage/'.$slika->putanja) }}"
     class="d-block w-100 rounded"
     style="height:380px; object-fit:cover;"
     alt="{{ $oglas->naslov }}">


    <thead><tr><th>ID</th><th>Naslov</th><th>Postavio</th><th>Akcija</th></tr></thead>
    <tbody>
    @foreach($pendingOglasi as $oglas)
      <tr>
        <td>{{ $oglas->id }}</td>
        <td>{{ $oglas->marka }} {{ $oglas->model }}, {{ $oglas->godiste }}</td>
        <td>{{ $oglas->korisnik->ime }} {{ $oglas->korisnik->prezime }}</td>
        <td>
          <form method="POST" action="/admin/oglasi/{{ $oglas->id }}/odobri" class="d-inline">@csrf <button class="btn btn-success btn-sm">Odobri</button></form>
          <form method="POST" action="/admin/oglasi/{{ $oglas->id }}/odbij" class="d-inline">@csrf <button class="btn btn-danger btn-sm">Odbij</button></form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endif
<h5 class="mt-4">Odbijeni oglasi</h5>
@if($rejectedOglasi->isEmpty())
  <p>Nema odbijenih oglasa.</p>
@else
  <ul>
    @foreach($rejectedOglasi as $oglas)
      <li>Oglas #{{ $oglas->id }} - {{ $oglas->marka }} {{ $oglas->model }} (odbijen)</li>
    @endforeach
  </ul>
@endif
@endsection
