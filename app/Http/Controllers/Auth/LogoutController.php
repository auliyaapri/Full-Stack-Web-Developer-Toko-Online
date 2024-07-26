<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Session::flash('success', 'Anda berhasil logout.');

        return redirect('/');
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     Session::flash('success', 'Anda berhasil login.');
    //     return redirect()->intended($this->redirectPath());
    // }
}
