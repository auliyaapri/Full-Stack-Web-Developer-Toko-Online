<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\Regency;


use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with(['product','user'])->where('users_id', Auth::user()->id)->get();
        $regency = Regency::where('id', Auth::user()->regencies_id)->first();
        $province = Province::where('id', Auth::user()->provinces_id)->first();

        return view('pages.cart',[
            'carts' => $carts,
            'regency'  => $regency,
            'province'  => $province,


        ]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('cart');
        
    }
    public function success()
    {
        return view('pages.success');
    }

}
