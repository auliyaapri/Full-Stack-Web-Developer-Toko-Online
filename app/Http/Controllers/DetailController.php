<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     public function index(Request $request, $id) 
     {
         // Mengambil produk berdasarkan slug dari database
         $products = Product::with(['galleries', 'user']) // Mengambil data produk beserta galeri dan user yang terkait
                            ->where('slug', $id) // Mencari produk dengan slug yang sama dengan $id
                            ->firstOrFail(); // Mengambil data pertama yang ditemukan, jika tidak ada maka akan menghasilkan error 404
    
                            $user = Auth::user();
                            $reviews = Review::where('products_id', $products->id)->get();
                            $review_count = Review::where('products_id', $products->id)->get()->count();
                            return view('pages.detail', [
                                'user' => $user,
                                'products' => $products, // Mengirimkan data produk ke view
                                'reviews' => $reviews,
                                'review_count' => $review_count
                            ]);
     }
     

     public function add(Request $request, $id) 
     {

        if (!Auth::check()) {
            // Pengguna belum login, arahkan ke halaman login dengan pesan peringatan
            dd('oke');
        }
        

        
        $data = $request->all();
        
         Cart::create($data);
         return redirect()->route('cart');
     }
     
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
