<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    

    public function index()
     {
        $products = Product::with(['user', 'category'])->get();


        return view('pages.admin.product.index',[
            'products' => $products
        ]);
        
    }

    // public function index()
    // {
    //     // Memeriksa apakah request yang diterima adalah ajax request
    //     if (request()->ajax()) {
    //         // Membuat query builder untuk model Product
    //         $query = Product::with(['user', 'category']);

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
    //                             <a href="' . route('product.edit', $item->id) . '" class="dropdown-item">
    //                                 Sunting
    //                             </a>
    //                             <form action="' . route('product.destroy', $item->id) . '" method="POST">
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
    //     return view('pages.admin.product.index');
    // }



    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('pages.admin.product.create', [
            'users'         => $users,
            'categories'    => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Product::create($data);

        return redirect()->route('product.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $item = Product::with(['user', 'category'])->findOrFail($id);
        $users = User::all();
        $categories = Category::all();
        return view('pages.admin.product.edit', [
            'users' => $users,
            'categories' => $categories,
            'item' => $item


        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id); // Menggunakan $id sebagai parameter

        $data['slug'] = Str::slug($request->name);


        $item->update($data); // Menyimpan perubahan data
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete(); // Menggunakan findOrFail untuk menemukan dan menghapus kategori
        // Menambahkan alert JavaScript     
        return redirect()->route('product.index');
    }
}
