<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::sum('total_price'); // di hitung dari total_price;
        $transaction = Transaction::count(); // di hitung dari ada berapa datanya itu sendiri
        return view('pages.admin.dashboard',[
            'revenue' => $revenue,
            'customer' => $customer,
            'transaction' => $transaction,
        ]);
    }
}