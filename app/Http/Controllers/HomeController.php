<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan daftar kategori dalam format JSON.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function categories()
    // {
    //     $categories = Category::all();
    //     return response()->json($categories);
    // }

    /**
     * Menampilkan halaman utama dengan daftar kategori dan produk.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with(['galleries'])->take(8)->get();
        
        return view('pages.home', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
