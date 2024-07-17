<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pages.home');
// });

// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry okee!');
// });

Auth::routes();
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// === PRODUCT ===
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');

// === DETAIL ===
Route::get('/details/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\DetailController::class, 'add'])->name('detail-add');
// === CHECKOUT ===
// Route::post('/midtrans-callback', [App\Http\Controllers\CheckoutController::class, 'callback']);
Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('success');


// === Middleware / Satapam ===
Route::group(['middleware' => ['auth']], function () {
    // === CART ===
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');
    // === CHECKOUT ===
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');

    // === DASHBOARD ===
    // Rute untuk tampilan dasbor utama
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/jajal', [App\Http\Controllers\DashboardController::class, 'jajal'])->name('jajal');

    // Rute untuk tampilan produk di dasbor
    Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'index'])->name('dashboard-product');
    
    Route::get('/dashboard/products/create', [App\Http\Controllers\DashboardProductController::class, 'create'])->name('dashboard-products-create');

    Route::post('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'store'])->name('dashboard-products-store');
    Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])->name('dashboard-products-details');
    Route::post('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'update'])->name('dashboard-products-update');
    
    Route::post('/dashboard/products/gallery/upload', [App\Http\Controllers\DashboardProductController::class, 'uploadGallery'])->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [App\Http\Controllers\DashboardProductController::class, 'deleteGallery'])->name('dashboard-product-gallery-delete');

    // Rute untuk tampilan transaksi di dasbor
    Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionController::class, 'index'])->name('dashboard-transactions');    
    Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'details'])->name('dashboard-transactions-details');
    Route::post('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'update'])->name('dashboard-transactions-update');
    
    Route::post('/dashboard/transactions/{id}/add_review', [App\Http\Controllers\ReviewController::class,'add'])->name('dashboard-review-add');
    Route::post('/dashboard/transactions/{id}/update_review', [App\Http\Controllers\ReviewController::class,'update'])->name('dashboard-review-update');



    // === DASHBOARD PAGE MY ACCOUNT ===
    Route::get('/dashboard/account', [App\Http\Controllers\DashboardSettingController::class, 'account'])->name('dashboard-settings-account');
    Route::delete('/dashboard/account/{id}', [App\Http\Controllers\DashboardSettingController::class, 'destroy'])->name('dashboard-settings-account.destroy');

    Route::post('/dashboard/update/{redirect}', [App\Http\Controllers\DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect'); // ini maksudnya redirect ke halaman yang sebelumnya dibuka ya kakaka
    
    // === DASHBOARD PAGE STORE SETTINGS ===
    Route::get('/dashboard/settings/store', [App\Http\Controllers\DashboardSettingController::class, 'store'])->name('dashboard-settings-store');
    
    
    
    Route::get('/store/{id}', [App\Http\Controllers\Admin\StoreController::class, 'detail'])->name('store-detail');
    Route::put('/store/{id}', [App\Http\Controllers\Admin\StoreController::class, 'update'])->name('store-update-store');




    
});

Route::prefix('admin')
->middleware(['auth','admin'])
->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('product-gallery', \App\Http\Controllers\Admin\ProductGalleryController::class);
    Route::resource('transaction', \App\Http\Controllers\Admin\TransactionController::class);
    Route::resource('store', \App\Http\Controllers\Admin\StoreController::class);
});
