@extends('layouts.app')
@section('content')
<div class="container">
  <h2 class="mb-3">Kontakt</h2>
  <p>
    Za sva pitanja, sugestije ili podršku, možete nas kontaktirati putem sledećih podataka:
  </p>
  <ul>
    <li><strong>Ime i prezime:</strong> Luka Stanković</li>
    <li><strong>Email:</strong> <a href="mailto:lstankovic4122it@raf.rs">lstankovic4122it@raf.rs</a></li>
    <li><strong>Adresa:</strong> Karađorđeva 18, 11300 Smederevo</li>
  </ul>

  <div class="mt-4">
    <h5>Naša lokacija</h5>
    <div class="ratio ratio-16x9">
      <iframe 
        src="https://www.google.com/maps?q=Karađorđeva+18,+Smederevo&output=embed" 
        style="border:0;" allowfullscreen="" loading="lazy">
      </iframe>
    </div>
  </div>
</div>
@endsection
