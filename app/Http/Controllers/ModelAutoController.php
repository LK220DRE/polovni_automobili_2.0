<?php

namespace App\Http\Controllers;

use App\Models\ModelAuto;
use App\Models\Marka;
use Illuminate\Http\Request;

class ModelAutoController extends Controller
{
    public function index()
    {
        $modeli = ModelAuto::with('marka')->get();
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
            'naziv' => 'required',
            'marka_id' => 'required|exists:markas,id',
        ]);

        ModelAuto::create([
            'naziv' => $request->naziv,
            'marka_id' => $request->marka_id,
        ]);

        return redirect()->route('modeli.index')->with('success', 'Model uspešno dodat.');
    }

    public function destroy(ModelAuto $model)
    {
        $model->delete();
        return redirect()->route('modeli.index')->with('success', 'Model uspešno obrisan.');
    }
}
