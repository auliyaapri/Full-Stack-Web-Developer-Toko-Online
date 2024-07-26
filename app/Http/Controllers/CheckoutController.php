<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Midtranss
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;


class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // == save user data ==
        // Mengambil informasi pengguna yang sedang masuk
        $user = Auth::user();



        // Memperbarui data pengguna kecuali total harga
        $user->update($request->except('total_price'));

        // == proses checkout ==
        // Membuat kode unik untuk transaksi
        $code = 'STORE_-' . mt_rand(000000, 999999);
        // Mengambil semua barang dalam keranjang yang dimiliki oleh pengguna yang sedang masuk
        $carts = Cart::with(['product', 'user'])->where('users_id', Auth::user()->id)->get();

        // == Transaction create ==
        // Membuat entri transaksi baru

        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurence_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        // Menyimpan detail transaksi untuk setiap barang dalam keranjang
        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(0000, 9999);
        
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                // 'price' => $transaction->total_price,
                'price' => $cart->product->price,
                'quantity' => $cart->quantity,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        
            // Mengurangi stok produk berdasarkan jumlah yang dibeli
            Product::where('id', $cart->product->id)->decrement('quantity', $cart->quantity);
        }
        
        // ====== ini masihg jajajl =====
        // $buyTransaction = TransactionDetail::with(['transaction.user', 'product.galleries'])->whereHas('transaction', function ($transaction) {
        //     $transaction->where('users_id', Auth::user()->id);
        // })->get();
        $buyTransaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
        ->whereHas('transaction', function ($transaction) {
            $transaction->where('users_id', Auth::user()->id)
                ->whereDate('created_at', today()) // Filter berdasarkan tanggal hari ini
                ->whereTime('created_at', '>=', now()->subSeconds(1)); // Filter berdasarkan waktu hingga detik
        })->get();
    

        $item_details = [];
        foreach ($buyTransaction as $transaction) {
            $item_details[] = [
                'id' => $transaction->product->id,
                'name' => $transaction->product->name,
                'quantity' => $transaction->quantity,
                'price' => $transaction->price,
                'subtotal' => $transaction->total_price,
            ];
        }
        // ====== ini masihg jajajl =====

        // === Untuk menghapus cart data setelah di checkout ===
        // Menghapus semua data dalam keranjang setelah proses checkout selesai
        Cart::with(['product', 'user'])->where('users_id', Auth::user()->id)->delete();

        // ==== Konfigurasi Menggunakan Midtrans ====
        // Mengatur konfigurasi untuk menggunakan Midtrans sebagai gateway pembayaran
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // ===== Mmebuat array untuk dikirim ke midtrans
        // Membuat array parameter untuk dikirimkan ke Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ),
            'customer_details' => array(
                'first_name'    => Auth::user()->name,
                'email'         => Auth::user()->email,
                'phone'       => Auth::user()->phone_number,
                'billing_address' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone_number,
                    'address' => Auth::user()->address_one,
                ],
                'shipping_address' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone_number,
                    'address' => Auth::user()->address_one
                ],
            ),
            'item_details' => $item_details,


            // 'enabled_payments' => array('gopay', 'bank_transfer'),
            // 'vtweb' => array()
        );
        try {
            // Ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($params)->redirect_url;

            // Redirect ke halaman midtrans
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        // return view('checkout', compact('snapToken','order'));    
    }


    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            // if($request->transaction_status == 'capture'){
            //     $transaction = Transaction::where('code', $request->order_id)->first();

            //     if ($transaction) {
            //         $transaction->update(['transaction_status' => 'SUCCESS']);
            //     } else {
        //         
            //         error_log("Transaction not found: " . $request->order_id);
            //     }
            // }
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $transaction = Transaction::where('code', $request->order_id)->first();

                if ($transaction) {
                    $transaction->update(['transaction_status' => 'SUCCESS']);
                } else {                    
                    error_log("Transaction not found: " . $request->order_id);
                }
            }
        }
    }
}
