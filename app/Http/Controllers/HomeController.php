<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $categories = Category::take(8)->get();
        $products = Product::with(['galleries'])->take(8)->orderBy('created_at', 'desc')->get();        
        $user = Auth::user();
        
        return view('pages.home', [
            'user' => $user,
            'categories' => $categories,
            'products' => $products
        ]);
    }
}

