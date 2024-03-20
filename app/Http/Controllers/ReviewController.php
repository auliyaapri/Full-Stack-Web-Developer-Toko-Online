<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $products_id = Product::find($id);

        $review = new Review;
        $review->users_id = Auth::id();
        $review->transactions_id = $transaction->id;
        $review->products_id = $products_id->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        dd($review);

        // dd($request->rating, $request->comment);
        
    }
}
