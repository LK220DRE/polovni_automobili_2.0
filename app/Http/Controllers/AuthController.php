<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Kontroler za autentifikaciju korisnika (registracija, prijava, odjava).
 */
class AuthController extends Controller
{
    /** Prikaz forme za registraciju. */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /** Obrada zahteva za registraciju novog korisnika. */
    public function register(Request $request)
    {
        // Validacija ulaznih podataka
        $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ], [
            'ime.required' => 'Ime je obavezno.',
            'prezime.required' => 'Prezime je obavezno.',
            'email.required' => 'Email je obavezan.',
            'email.email' => 'Email format nije validan.',
            'email.unique' => 'Nalog sa ovom email adresom već postoji.',
            'password.required' => 'Lozinka je obavezna.',
            'password.min' => 'Lozinka mora imati najmanje 6 karaktera.',
            'password.confirmed' => 'Potvrda lozinke se ne poklapa.'
        ]);

        // Kreiranje novog korisnika
        $user = User::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Automatska prijava novog korisnika
        Auth::login($user);

        return redirect('/')->with('success', 'Uspešna registracija. Dobrodošli!');
    }

    /** Prikaz forme za prijavu. */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /** Obrada zahteva za prijavu korisnika. */
    public function login(Request $request)
    {
        // Validacija ulaznih podataka
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email je obavezan.',
            'email.email' => 'Email format nije validan.',
            'password.required' => 'Lozinka je obavezna.'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Uspešno ste prijavljeni.');
        }

        return back()->withErrors(['email' => 'Pogrešni kredencijali. Pokušajte ponovo.']);
    }

    /** Odjava korisnika. */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Uspešno ste se odjavili.');
    }
}
