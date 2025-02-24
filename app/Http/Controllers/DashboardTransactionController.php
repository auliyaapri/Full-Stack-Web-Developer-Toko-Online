<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // Untuk penjual melihat produk apa saja yang sudah terjual
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function ($product) {
                $product->where('users_id', Auth::user()->id);
            })->orderBy('created_at', 'desc')
            ->get();

        // Untuk pembeli apa saja yang sudah di beli
        $buyTransaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function ($transaction) {
                // Memfilter hanya produk yang dimiliki oleh pengguna yang sedang login
                $transaction->where('users_id', Auth::user()->id);
            })->orderBy('created_at', 'desc')
            ->get();


        return view('pages.dashboard-transactions', [
            'user' => $user,
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransaction
        ]);
    }

    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])->findOrFail($id);


        // Memeriksa apakah pengguna yang terautentikasi sama dengan pengguna yang terkait dengan transaksi
        // if ($transaction->transaction->users_id !== Auth::user()->id) {
        //     abort(403); // Jika tidak sama, kembalikan respons 403 (Forbidden)
        // }
        
        // $review = Review::where('users_id', Auth::user()->id)->where('transactions_id', $transaction->id)->first();
        $review = Review::where('users_id', Auth::user()->id)->where('transactions_id', $transaction->transaction->id)->first();

        // Mengembalikan view dengan data yang diperlukan
        return view('pages.dashboard-transactions-details', [
            'transaction' => $transaction,
            'review' => $review,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = TransactionDetail::findOrFail($id);

        $item->update($data);
        return redirect()->route('dashboard-transactions-details', $id);
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
