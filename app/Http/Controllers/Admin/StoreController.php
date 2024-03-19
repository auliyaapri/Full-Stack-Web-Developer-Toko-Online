<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionGallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    
     public function index()
    {
        $get_user = User::whereNotNull('store_name')->get();
        return view('pages.admin.store.index', compact('get_user'));
    }

    public function detail(Request $request, $id)
    {
        $user = User::with('category')->findOrFail($id);
        $categoryTable = Category::all();
    
        // Mengambil kategori yang terkait dengan pengguna berdasarkan categories_id
        $category = $user->category;
    
        if (!$user) {
            abort(404); // Menangani kasus di mana pengguna tidak ditemukan.
        }
    
        return view('pages.admin.store.edit',[
            'user' => $user,
            'category' => $category,
            'categoryTable' => $categoryTable
        ]);
    }
    

    public function update(Request $request, string $id)
    {
        $user_store = User::findOrFail($id);
        $user_store->update(request()->all());

        return redirect()->route('store.index');


        
    }
    
    
    

    public function create()
    {
        $transactions = Transaction::all();

        return view('pages.admin.transaction-gallery.create', [
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request)
    {
    }
    public function show(string $id)
    {
    }
    
}
