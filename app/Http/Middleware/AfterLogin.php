<?php

namespace App\Http\Middleware;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class AfterLogin
{
    public function handle($request, Closure $next)
    {
        Alert::success('Berhasil', 'Anda telah berhasil login');
        return $next($request);
        dd( $next);
    }
}
