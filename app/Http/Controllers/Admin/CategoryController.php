<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        // Memeriksa apakah request yang diterima adalah ajax request
        if (request()->ajax()) {
            // Membuat query builder untuk model Category
            $query = Category::query();

            // Menggunakan datatables untuk memproses data dari query builder
            return DataTables::of($query)
                // Menambahkan kolom tambahan ('action') menggunakan fungsi callback
                ->addColumn('action', function ($item) {
                    // Markup HTML yang berisi aksi-aksi yang akan ditampilkan di dalam tabel
                    return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                                <a href="' . route('category.edit', $item->id) . '" class="dropdown-item">
                                    Sunting
                                </a>
                                <form action="' . route('category.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
                })
                // Mengedit kolom 'photo' untuk menampilkan gambar jika tersedia
                ->editColumn('photo', function ($item) {
                    // Mengecek apakah photo tersedia
                    return $item->photo ? '<img src="' . Storage::url($item->photo) . '" style="max-height: 40px;" />' : '';
                })
                // Menggunakan method rawColumns() untuk memberitahu datatables bahwa kolom 'action' dan 'photo' merupakan markup HTML yang sudah di-render dan tidak perlu di-escape
                ->rawColumns(['action', 'photo'])
                // Menggunakan method make() untuk membuat dan menampilkan datatables, dengan parameter true menandakan bahwa data akan langsung dikirim ke client
                ->make(true);
        }

        // Jika request bukan ajax request, maka akan mereturn view yang akan menampilkan halaman dengan datatables untuk kategori
        return view('pages.admin.category.index');
    }



    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);   
        $data['photo'] = $request->file('photo')->store('assets/category','public');


        Category::create($data);
        return redirect()->route('category.index');
       
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
        $item = Category::findOrFail($id);
        return view('pages.admin.category.edit', [
            'item' => $item

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $item = Category::findOrFail($id); // Menggunakan $id sebagai parameter

        $oldPhoto = $item->photo;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('assets/category', 'public');
            
            if ($oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        }
        
    
        $item->update($data); // Menyimpan perubahan data
    
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    Category::findOrFail($id)->delete(); // Menggunakan findOrFail untuk menemukan dan menghapus kategori
    // Menambahkan alert JavaScript     
    return redirect()->route('category.index');
}

    
}
