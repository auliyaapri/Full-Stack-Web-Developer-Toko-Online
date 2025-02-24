<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionGallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    
    public function index()
    {
        // $transactions = Transaction::with(['user'])->get();
        $transactions = Transaction::with(['user' => function ($query) {
            $query->withTrashed();
        }])->get();
        
        return view('pages.admin.transaction.index',[
            'transactions' => $transactions
        ]);
    }

    // public function index()de
    // {
    //     // Memeriksa apakah request yang diterima adalah ajax request
    //     if (request()->ajax()) {
    //         // Membuat query builder untuk model Transaction
    //         $query = Transaction::with(['user']);

    //         // Menggunakan datatables untuk memproses data dari query builder
    //         return DataTables::of($query)
    //             // Menambahkan kolom tambahan ('action') menggunakan fungsi callback
    //             ->addColumn('action', function ($item) {
    //                 // Markup HTML yang berisi aksi-aksi yang akan ditampilkan di dalam tabel
    //                 return '
    //                 <div class="btn-group">
    //                     <div class="dropdown">
    //                         <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
    //                             Aksi
    //                         </button>
    //                         <div class="dropdown-menu">
    //                             <a href="' . route('transaction.edit', $item->id) . '" class="dropdown-item">
    //                                 Sunting
    //                             </a>
    //                             <form action="' . route('transaction.destroy', $item->id) . '" method="POST">
    //                                 ' . method_field('delete') . csrf_field() . '
    //                                 <button type="submit" class="dropdown-item text-danger">Hapus</button>
    //                             </form>
    //                         </div>
    //                     </div>
    //                 </div>';
    //             })
    //             // Menggunakan method rawColumns() untuk memberitahu datatables bahwa kolom 'action' dan 'photo' merupakan markup HTML yang sudah di-render dan tidak perlu di-escape
    //             ->rawColumns(['action'])
    //             // Menggunakan method make() untuk membuat dan menampilkan datatables, dengan parameter true menandakan bahwa data akan langsung dikirim ke client
    //             ->make(true);
    //     }
    //     // Jika request bukan ajax request, maka akan mereturn view yang akan menampilkan halaman dengan datatables untuk kategori
    //     return view('pages.admin.transaction.index');
    // }

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
    public function edit(string $id)
    {
        $item = Transaction::findOrFail($id);
        return view('pages.admin.transaction.edit', [   
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Transaction::findOrFail($id); // Menggunakan $id sebagai parameter

        $user = $item->user; // Mendapatkan user yang terkait dengan transaksi

        $user->name = $data['name']; // Mengubah nama user
        $user->save(); // Menyimpan perubahan pada user
    
        $item->update($data); // Menyimpan perubahan data

        return redirect()->route('transaction.index');

    }
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete(); // Menggunakan findOrFail untuk menemukan dan menghapus kategori
        // Menambahkan alert JavaScript     
        return redirect()->route('product.index');
    }
}
