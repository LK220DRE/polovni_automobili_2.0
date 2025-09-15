@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Kontaktirajte nas</h2>

    <p>
        Ako imate bilo kakva pitanja, predloge ili želite da prijavite problem, slobodno nas kontaktirajte putem formulara ispod.
        Naš tim će vam odgovoriti u najkraćem mogućem roku.
    </p>

    <form action="#" method="POST" class="p-4 bg-light rounded shadow-sm">
        @csrf
        <div class="form-group mb-3">
            <label for="ime">Ime</label>
            <input type="text" name="ime" id="ime" class="form-control" placeholder="Unesite ime" required>
        </div>
        <div class="form-group mb-3">
            <label for="prezime">Prezime</label>
            <input type="text" name="prezime" id="prezime" class="form-control" placeholder="Unesite prezime" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">E-mail adresa</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="primer@mail.com" required>
        </div>
        <div class="form-group mb-3">
            <label for="telefon">Broj telefona</label>
            <input type="text" name="telefon" id="telefon" class="form-control" placeholder="+381 64 123 4567" required>
        </div>
        <div class="form-group mb-3">
            <label for="poruka">Poruka</label>
            <textarea name="poruka" id="poruka" rows="5" class="form-control" placeholder="Napišite svoju poruku" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">📩 Pošalji poruku</button>
    </form>

    <div class="mt-4">
        <h5>Naši kontakt podaci:</h5>
        <p><strong>Email:</strong> lstankovic4122it@raf.rs</p>
        <p><strong>Telefon:</strong> +381 11 123 456</p>
        <p><strong>Adresa:</strong> Karadjorjdeva 18, Smederevo</p>
    </div>
</div>
@endsection
