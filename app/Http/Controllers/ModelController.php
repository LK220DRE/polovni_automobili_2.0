<?php

namespace App\Http\Controllers;

use App\Models\Modeli;
use App\Models\Marka;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function index()
    {
        $modeli = Modeli::with('marka')->get();
        return view('modeli.index', compact('modeli'));
    }

    public function create()
    {
        $marke = Marka::all();
        return view('modeli.create', compact('marke'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|string|max:100',
            'marka_id' => 'required|exists:markas,id'
        ]);

        Modeli::create([
            'naziv' => $request->naziv,
            'marka_id' => $request->marka_id
        ]);

        return redirect()->route('modeli.index')->with('success', 'Model je uspešno dodat.');
    }

    public function destroy(Modeli $modeli)
    {
        $modeli->delete();
        return redirect()->route('modeli.index')->with('success', 'Model je obrisan.');
    }
}
