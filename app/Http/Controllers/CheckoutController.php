<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
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
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }
    
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
            ),
            'enabled_payments' => array('gopay', 'bank_transfer'),
            'vtweb' => array()
        );
    
        try {
            // Get Snap Payment Page URL
            // Mendapatkan URL halaman pembayaran Snap
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
    
            // Redirect to Snap Payment Page
            // Mengarahkan pengguna ke halaman pembayaran Snap
            return redirect($paymentUrl);
        } catch (Exception $e) {
            // Menangani kesalahan jika terjadi kesalahan pada proses pembuatan transaksi
            echo $e->getMessage();
        }
    }
    
    public function callback(Request $request)
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction->status = 'PENDING';
                }
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }
        else if ($status == 'settlement'){
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'pending'){
            $transaction->status = 'PENDING';
        }
        else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        }
        else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        }
        else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        // Simpan transaksi
        $transaction->save();

        // Kirimkan email
        if ($transaction)
        {
            if($status == 'capture' && $fraud == 'accept' )
            {
                //
            }
            else if ($status == 'settlement') // jika pembayaran berhasil
            {
                //
            }
            else if ($status == 'success')
            {
                //
            }
            else if($status == 'capture' && $fraud == 'challenge' )
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge'
                    ]
                ]);
            }
            else
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment not Settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);
        }
    }
}
