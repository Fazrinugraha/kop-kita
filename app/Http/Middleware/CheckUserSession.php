<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class CheckUserSession
{

    public function handle($request, Closure $next, ...$levels)
    {
        // Cek untuk setiap level yang diberikan sebagai parameter
        foreach ($levels as $level) {
            // Gunakan guard sesuai dengan level yang diperiksa
            if (Auth::guard($level)->check()) {
                // Jika pengguna terautentikasi dengan guard ini, lanjutkan request
                return $next($request);
            }
            else{
                return redirect('/login');
            }
        }
        
    }

}