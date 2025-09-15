<?php
namespace App\Http\Controllers;

use App\Models\Oglas;
use App\Models\Fotografija;
use App\Models\TipGoriva;
use App\Models\Karoserija;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OglasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show','kontakt']);
    }

    /** Početna + pretraga */
    public function index(Request $request)
    {
        $oglasiQuery = Oglas::where('status', 'odobren');

        if ($request->filled('marka')) $oglasiQuery->where('marka', 'like', '%'.$request->marka.'%');
        if ($request->filled('model')) $oglasiQuery->where('model', 'like', '%'.$request->model.'%');
        if ($request->filled('godiste_od')) $oglasiQuery->where('godiste', '>=', $request->godiste_od);
        if ($request->filled('godiste_do')) $oglasiQuery->where('godiste', '<=', $request->godiste_do);
        if ($request->filled('cena_od')) $oglasiQuery->where('cena', '>=', $request->cena_od);
        if ($request->filled('cena_do')) $oglasiQuery->where('cena', '<=', $request->cena_do);
        if ($request->filled('gorivo')) $oglasiQuery->where('tip_goriva_id', $request->gorivo);
        if ($request->filled('karoserija')) $oglasiQuery->where('karoserija_id', $request->karoserija);
        if ($request->filled('lokacija')) $oglasiQuery->where('lokacija', 'like', '%'.$request->lokacija.'%');

        // Sortiranje
        if ($request->sort === 'cena_desc') $oglasiQuery->orderBy('cena', 'desc');
        elseif ($request->sort === 'cena_asc') $oglasiQuery->orderBy('cena', 'asc');
        else $oglasiQuery->orderBy('created_at', 'desc');

        $oglasi = $oglasiQuery->paginate(10);
        $tipoviGoriva = TipGoriva::all();
        $karoserije = Karoserija::all();

        return view('oglasi.index', compact('oglasi', 'tipoviGoriva', 'karoserije'));
    }

    /** Forma za kreiranje */
    public function create()
    {
        $tipoviGoriva = TipGoriva::all();
        $karoserije = Karoserija::all();
        return view('oglasi.create', compact('tipoviGoriva', 'karoserije'));
    }

    /** Čuvanje novog oglasa */
    public function store(Request $request)
    {
        $request->validate([
            'marka' => 'required',
            'model' => 'required',
            'godiste' => 'required|integer',
            'cena' => 'required|integer',
            'opis' => 'required',
            'gorivo' => 'required|exists:tip_goriva,id',
            'karoserija' => 'required|exists:karoserije,id',
            'kilometraza' => 'required|integer',
            'snaga_motora' => 'required|integer',
            'boja' => 'required',
            'lokacija' => 'required',
            'slike' => 'required',
            'slike.*' => 'image|mimes:jpeg,png,jpg|max:4096'
        ]);

        $oglas = Oglas::create([
            'user_id'       => Auth::id(),
            'naslov'        => $request->naslov ?? ($request->marka . ' ' . $request->model . ' ' . $request->godiste),
            'marka'         => $request->marka,
            'model'         => $request->model,
            'godiste'       => $request->godiste,
            'cena'          => $request->cena,
            'opis'          => $request->opis,
            'tip_goriva_id' => $request->gorivo,
            'karoserija_id' => $request->karoserija,
            'kilometraza'   => $request->kilometraza,
            'snaga_motora'  => $request->snaga_motora,
            'boja'          => $request->boja,
            'lokacija'      => $request->lokacija,
            'status'        => 'na_cekanju',
        ]);

        // Snimanje slika sa originalnim nazivom
        if ($request->hasFile('slike')) {
            foreach ($request->file('slike') as $index => $slika) {
                $original = pathinfo($slika->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = $slika->getClientOriginalExtension();
                $imeFajla = time() . '_' . $oglas->id . '_' . $index . '_' . \Str::slug($original) . '.' . $ext;

                $slika->storeAs('oglasi', $imeFajla, 'public');

                Fotografija::create([
                    'oglas_id' => $oglas->id,
                    'putanja' => 'oglasi/' . $imeFajla
                ]);
            }
        }

        return redirect('/oglasi/'.$oglas->id)
            ->with('success', 'Oglas je uspešno postavljen i čeka odobrenje.');
    }

    /** Detalji oglasa */
    public function show(Oglas $oglas)
    {
        if ($oglas->status !== 'odobren') {
            if (Auth::check() && (Auth::id() === $oglas->user_id || Auth::user()->is_admin)) {
                $oglas->load('fotografije','korisnik','tipGoriva','karoserija');
                return view('oglasi.show', compact('oglas'));
            }
            return view('oglasi.nedostupan', compact('oglas'));
        }

        $oglas->load('fotografije','korisnik','tipGoriva','karoserija');
        return view('oglasi.show', compact('oglas'));
    }

    /** Kontakt forma */
    public function kontakt(Request $request, Oglas $oglas)
    {
        $request->validate([
            'ime' => 'required',
            'email' => 'required|email',
            'poruka' => 'required'
        ]);

        $prodavac = $oglas->korisnik;
        $sadrzaj = "Poruka od: {$request->ime} ({$request->email}):\n{$request->poruka}";

        Mail::raw($sadrzaj, function($message) use ($prodavac, $oglas) {
            $message->to($prodavac->email)
                    ->subject('Upit za oglas #'.$oglas->id);
        });

        return back()->with('success', 'Vaša poruka je poslata prodavcu.');
    }

    /** Edit forma */
    public function edit(Oglas $oglas)
    {
        if (Auth::id() !== $oglas->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
        $tipoviGoriva = TipGoriva::all();
        $karoserije = Karoserija::all();
        return view('oglasi.edit', compact('oglas','tipoviGoriva','karoserije'));
    }

    /** Update */
    public function update(Request $request, Oglas $oglas)
    {
        $user = Auth::user();
        if ($user->id !== $oglas->user_id && !$user->is_admin) {
            abort(403);
        }

        if ($user->is_admin && $request->has('status')) {
            $request->validate(['status' => 'in:na_cekanju,odobren,odbijen,prodat']);
            $oglas->status = $request->status;
            $oglas->save();
            return redirect('/admin/oglasi')->with('success', 'Status oglasa promenjen.');
        }

        $request->validate([
            'marka' => 'required',
            'model' => 'required',
            'godiste' => 'required|integer',
            'cena' => 'required|integer',
            'opis' => 'required',
            'gorivo' => 'required|exists:tip_goriva,id',
            'karoserija' => 'required|exists:karoserije,id',
            'kilometraza' => 'required|integer',
            'snaga_motora' => 'required|integer',
            'boja' => 'required',
            'lokacija' => 'required'
        ]);

        $oglas->naslov = $request->naslov ?? ($request->marka.' '.$request->model.' '.$request->godiste);
        $oglas->marka = $request->marka;
        $oglas->model = $request->model;
        $oglas->godiste = $request->godiste;
        $oglas->cena = $request->cena;
        $oglas->opis = $request->opis;
        $oglas->tip_goriva_id = $request->gorivo;
        $oglas->karoserija_id = $request->karoserija;
        $oglas->kilometraza = $request->kilometraza;
        $oglas->snaga_motora = $request->snaga_motora;
        $oglas->boja = $request->boja;
        $oglas->lokacija = $request->lokacija;

        if (!$user->is_admin) {
            $oglas->status = 'na_cekanju';
        }
        $oglas->save();

        return redirect('/oglasi/'.$oglas->id)->with('success', 'Oglas je ažuriran.');
    }

    /** Delete */
    public function destroy(Oglas $oglas)
    {
        if (Auth::id() !== $oglas->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
        $oglas->delete();
        return redirect('/')->with('success', 'Oglas je obrisan.');
    }

    /** Moji oglasi */
    public function mojiOglasi()
    {
        $oglasi = Oglas::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('oglasi.moji', compact('oglasi'));
    }
}
