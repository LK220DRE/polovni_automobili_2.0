<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Proverava da li je korisnik administrator.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // ako nije prijavljen, preusmeri na login
            return redirect('/login');
        }
        if (!Auth::user()->is_admin) {
            abort(403);
        }
        return $next($request);
    }
}
