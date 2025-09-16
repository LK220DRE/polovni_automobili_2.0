<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $korisnici = User::withCount('oglasi')->orderBy('created_at','desc')->paginate(20);
        return view('admin.korisnici.index', compact('korisnici'));
    }

    public function show(User $user)
    {
        $oglasi = $user->oglasi()->with(['fotografije','tipGoriva','karoserija'])->latest()->paginate(12);
        return view('admin.korisnici.show', compact('user','oglasi'));
    }

    // ✅ Brisanje korisnika (osim samog sebe)
    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Ne možete obrisati sami sebe.');
        }

        $user->delete();

        return redirect()->route('admin.korisnici.index')->with('success', 'Korisnik je obrisan.');
    }
}
