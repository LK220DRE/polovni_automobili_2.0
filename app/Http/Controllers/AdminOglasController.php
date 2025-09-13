<?php
namespace App\Http\Controllers;

use App\Models\Oglas;
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

    /** Prikaz admin panela sa oglasima koji čekaju moderaciju. */
    public function index()
    {
        $pendingOglasi = Oglas::where('status', 'na čekanju')->orderBy('created_at')->get();
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
    public function cekaju()
    {
        // oglasi sa statusom "na_cekanju"
        $oglasi = Oglas::where('status', 'na_cekanju')->orderBy('created_at','desc')->paginate(10);

        return view('admin.oglasi_cekaju', compact('oglasi'));
    }

}
