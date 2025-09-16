<?php

namespace App\Http\Controllers;

use App\Models\Marka;
use Illuminate\Http\Request;

class MarkaController extends Controller
{
    public function index()
    {
        $marke = Marka::all();
        return view('admin.marke.index', compact('marke'));
    }

    public function store(Request $request)
    {
        $request->validate(['naziv' => 'required|string|max:100']);
        Marka::create($request->only('naziv'));
        return back()->with('success', 'Marka uspešno dodata.');
    }

    public function destroy(Marka $marka)
    {
        // Ako marka ima modele, možeš prvo obrisati njih
        if ($marka->modeli()->count() > 0) {
            return back()->with('error', 'Ne možeš obrisati marku jer ima pridružene modele.');
        }

        $marka->delete();
        return back()->with('success', 'Marka uspešno obrisana.');
    }
}
