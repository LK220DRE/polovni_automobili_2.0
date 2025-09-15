<?php

namespace App\Http\Controllers;

use App\Models\Marka;
use Illuminate\Http\Request;

class MarkaController extends Controller
{
    public function index()
    {
        $marke = Marka::all();
        return view('marke.index', compact('marke'));
    }

    public function create()
    {
        return view('marke.create');
    }

    public function store(Request $request)
    {
        $request->validate(['naziv' => 'required|unique:markas,naziv']);
        Marka::create(['naziv' => $request->naziv]);
        return redirect()->route('marke.index')->with('success', 'Marka uspešno dodata.');
    }

    public function destroy(Marka $marka)
    {
        $marka->delete();
        return redirect()->route('marke.index')->with('success', 'Marka uspešno obrisana.');
    }
}
