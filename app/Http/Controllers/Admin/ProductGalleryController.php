<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductGalleryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = ProductGallery::with(['product']); // Mengurutkan berdasarkan nama (huruf abjad)

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <div class="btn-group">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                            Aksi
                        </button>
                        <div class="dropdown-menu">                          
                            <form action="' . route('product-gallery.destroy', $item->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="dropdown-item text-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>';
                })
                ->editColumn('photos', function ($item) {
                    return $item->photos ? '<img src="' . Storage::url($item->photos) . '" style="max-height: 80px;"/>' : '';
                })
                ->rawColumns(['action','photos'])
                ->make();
        }

        return view('pages.admin.product-gallery.index');
    }

    
    
    public function create()
    {
        $products = Product::all();
        
        return view('pages.admin.product-gallery.create', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();

        // Proses upload foto
        $data['photos'] = $request->file('photos')->store('assets/product','public');

        ProductGallery::create($data);        
       

        return redirect()->route('product-gallery.index');

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $gallery = ProductGallery::findOrFail($id);
    
    // Menghapus gambar jika ada
    if (!empty($gallery->photos)) {
        Storage::disk('public')->delete($gallery->photos);
    }
    
    $gallery->delete(); // Menghapus entitas dari database

    return redirect()->route('product-gallery.index');
}
}
