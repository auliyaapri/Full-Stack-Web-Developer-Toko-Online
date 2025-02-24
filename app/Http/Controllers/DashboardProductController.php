<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::with(['galleries', 'category'])
        ->where('users_id', Auth::user()->id)
        ->get();
        return view('pages.dashboard-products',[
            'user' => $user,
            'products' => $products,
            'user' => $user

        ]);
    }
   
    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        // Proses upload foto        
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');

        ProductGallery::create($data);
        
        return redirect()->route('dashboard-products-details', $request->products_id);
        

    }

    public function deleteGallery(Request $request, $id)
    {
        $gallery = ProductGallery::findOrFail($id);
        // Menghapus gambar jika ada
        if (!empty($gallery->photos)) {
            Storage::disk('public')->delete($gallery->photos);
        }       
        $gallery->delete(); // Menghapus entitas dari database
        return redirect()->route('dashboard-products-details', $gallery->products_id);
    }


    public function details(Request $request, $id)
    {
        $products = Product::with(['user', 'galleries', 'category'])->findOrFail($id);
        $user = Auth::user();
        $categories = Category::all();
        return view('pages.dashboard-products-details', [
            'user' => $user,
            'products' => $products,
            'categories' => $categories
        ]);
                

    }
    
    public function create()
    {
        $categories = Category::all();
        $user = Auth::user();
        return view('pages.dashboard-products-create',[
            'categories' => $categories,
            'user' => $user
        ]);
    }

    

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
    
        $product = Product::create($data);
    
        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product', 'public')
        ];
        ProductGallery::create($gallery);
                
        Session::flash('success', 'Produk berhasil ditambahkan.');
        
        return redirect()->route('dashboard-product');
    }
    

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id); // Menggunakan $id sebagai parameter
        $data['slug'] = Str::slug($request->name);
        $item->update($data); // Menyimpan perubahan data
        Session::flash('success_edit_products', 'Produk berhasil di ubah!.');

        return redirect()->route('dashboard-product');
    }

    
}
