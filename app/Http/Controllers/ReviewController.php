<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $review = new Review;
        $review->users_id = Auth::id();
        $review->transactions_id = $transaction->id;
        $review->products_id = $request->products_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        // dd($review);
        $review->save();

        Session::flash('message', 'Anda berhasil login.');

        return back()->with('message', 'Rating / Ulasan berhasil ditambah');
    }


    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $products_id = Product::find($id);

        // Cari review yang sudah ada
        $review = Review::where('users_id', Auth::id())
            ->where('transactions_id', $transaction->id)
            ->where('products_id', $request->products_id)
            ->first();
        // Jika review tidak ditemukan, buat review baru
        if (!$review) {
            $review = new Review;
            $review->users_id = Auth::id();
            $review->transactions_id = $transaction->id;
            $review->products_id = $products_id->id;
        }
        // Update atau set nilai rating dan komentar
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        Session::flash('message', 'Anda berhasil login.');

        return back()->with('message', 'Rating / Ulasan berhasil diupdate');
    }
}
