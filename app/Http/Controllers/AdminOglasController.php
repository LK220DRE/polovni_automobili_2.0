<?php
namespace App\Http\Controllers;

use App\Models\Oglas;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Kontroler za administratorsku moderaciju oglasa.
 */
class AdminOglasController extends Controller
{
    public function __construct()
    {
        // Svi putevi u ovom kontroleru su za admina
        $this->middleware('admin');
    }

    /** Prikaz admin panela sa oglasima */
    public function index()
    {
        $pendingOglasi  = Oglas::where('status', 'na cekanju')->orderBy('created_at')->get();
        $rejectedOglasi = Oglas::where('status', 'odbijen')->orderBy('updated_at', 'desc')->get();

        return view('admin.oglasi', compact('pendingOglasi','rejectedOglasi'));
    }

    /** Odobravanje oglasa. */
    public function odobri($id)
    {
        $oglas = Oglas::findOrFail($id);
        $oglas->status = 'odobren';
        $oglas->save();

        return redirect('/admin/oglasi')->with('success', 'Oglas #'.$id.' je odobren.');
    }

    /** Odbijanje oglasa. */
    public function odbij($id)
    {
        $oglas = Oglas::findOrFail($id);
        $oglas->status = 'odbijen';
        $oglas->save();

        return redirect('/admin/oglasi')->with('success', 'Oglas #'.$id.' je odbijen.');
    }

    /** Oglasi na čekanju */
    public function cekaju()
    {
        $oglasi = Oglas::where('status', 'na cekanju')
                        ->orderBy('created_at','desc')
                        ->paginate(10);

        return view('admin.oglasi_cekaju', compact('oglasi'));
    }

    /** Lista korisnika */
    public function korisnici()
    {
        $korisnici = User::where('is_admin', false)->get();
        return view('admin.korisnici', compact('korisnici'));
    }

    /** Oglasi određenog korisnika */
    public function korisnikOglasi($id)
    {
        $korisnik = User::findOrFail($id);
        $oglasi   = Oglas::where('user_id', $id)->get();

        return view('admin.korisnik_oglasi', compact('korisnik','oglasi'));
    }
}
