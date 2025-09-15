@extends('layouts.app')
@section('content')
<h3>Korisnici</h3>
<ul class="list-group">
@foreach($korisnici as $korisnik)
    <li class="list-group-item">
        {{ $korisnik->ime }} {{ $korisnik->prezime }}
        <a href="{{ route('admin.korisnici.oglasi',$korisnik->id) }}" class="btn btn-info btn-sm float-right">Pogledaj oglase</a>
    </li>
@endforeach
</ul>
@endsection
