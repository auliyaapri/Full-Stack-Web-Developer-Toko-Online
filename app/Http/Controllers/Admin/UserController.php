<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function oke()
    {
        // Memeriksa apakah request yang diterima adalah ajax request
        if (request()->ajax()) {
            // Membuat query builder untuk model User
            $query = User::query();

            // Menggunakan datatables untuk memproses data dari query builder
            return DataTables::of($query)
                   // Menambahkan kolom tambahan ('DT_RowIndex') untuk nomor urutan
                   ->addColumn('DT_RowIndex', function ($item) {
                    return '';
                })
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
                                <a href="' . route('user.edit', $item->id) . '" class="dropdown-item">
                                    Sunting
                                </a>
                                <form action="' . route('user.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
                })
                // Menggunakan method rawColumns() untuk memberitahu datatables bahwa kolom 'action' dan 'photo' merupakan markup HTML yang sudah di-render dan tidak perlu di-escape
                ->rawColumns(['DT_RowIndex', 'action'])
                // Menggunakan method make() untuk membuat dan menampilkan datatables, dengan parameter true menandakan bahwa data akan langsung dikirim ke client
                ->make(true);
        }

        // Jika request bukan ajax request, maka akan mereturn view yang akan menampilkan halaman dengan datatables untuk kategori
        // return view('pages.admin.user.index');
    }

    public function index(){
        $users = User::where('roles','USER')->get();
        return view('pages.admin.user.index', [
            'users' => $users
        ]);
    }
    


    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();        
        $data['password'] = bcrypt($request->password);

        User::create($data);
        return redirect()->route('user.index');
       
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
        $item = User::findOrFail($id);
        return view('pages.admin.user.edit', [
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
        
        // Buat pengkondisian yang artinya jika 
        if ($request->password){
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);//Jika tidak ada password yang dikirimkan (misalnya, jika pengguna tidak ingin mengubah password mereka), maka variabel $data['password'] akan dihapus.
        }
    
        $item = User::findOrFail($id); // Menggunakan $id sebagai parameter
        $item->update($data); // Menyimpan perubahan data
    
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    User::findOrFail($id)->delete(); // Menggunakan findOrFail untuk menemukan dan menghapus kategori
    // Menambahkan alert JavaScript     
    return redirect()->route('user.index');
}

    
}


// https://youtu.be/Dle-W02AjoA 9 menit 41 detik




