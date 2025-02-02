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
