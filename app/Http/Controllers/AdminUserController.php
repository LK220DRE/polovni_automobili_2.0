<?php

namespace App\Http\Controllers;

use App\Models\User;

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
}
