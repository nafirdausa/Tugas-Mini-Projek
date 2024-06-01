<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifikasi apakah pengguna telah terautentikasi
        if (!Auth::check()) {
            // Redirect pengguna ke halaman login jika belum terautentikasi
            return redirect()->route('login')->with('error', 'Silakan login untuk mengakses halaman notifikasi.');
        }

        // Lanjutkan pemrosesan permintaan jika pengguna sudah terautentikasi
        return $next($request);
    }
}
