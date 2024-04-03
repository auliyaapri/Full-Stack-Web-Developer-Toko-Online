<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil detail transaksi dengan data terkait yang dimuat bersama
        // $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
        //                     ->whereHas('product', function ($product) {
        //                         // Memfilter hanya produk yang dimiliki oleh pengguna yang sedang login
        //                         $product->where('users_id', Auth::user()->id);
        //                     })->latest()->limit(5);
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                            ->whereHas('product', function ($product) {
                                // Memfilter hanya produk yang dimiliki oleh pengguna yang sedang login
                                $product->where('users_id', Auth::user()->id);
                            });
                   
    
        // Menghitung total pendapatan dari transaksi
        $revenue = $transactions->get()->reduce(function ($carry, $item) {
            return $carry + $item->price;
        });
    
        // Menghitung jumlah pelanggan
        $customer = User::count();
    
        // Mengembalikan view dashboard dengan data yang diperlukan
        return view('pages.dashboard', [
            'transaction_count' => $transactions->count(), // Jumlah transaksi
            'transaction_data' => $transactions->get(), // Data transaksi
            'revenue' => $revenue, // Pendapatan total
            'customer' => $customer, // Jumlah pelanggan
        ]);
    }
    
    
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function jajal()
    {
        return view('pages.dashboard2');
    }
}
