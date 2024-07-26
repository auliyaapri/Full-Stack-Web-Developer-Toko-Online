<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $products = Product::with(['galleries'])->simplePaginate(10); // Paginasi 10 produk per halaman

        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail($slug)
    {
        $categories = Category::take(6)->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->get(); // Mengambil produk yang sesuai dengan kategori

        return view('pages.category', [
            'categories' => $categories,
            'category' => $category,
            'products' => $products
        ]);
    }
}
