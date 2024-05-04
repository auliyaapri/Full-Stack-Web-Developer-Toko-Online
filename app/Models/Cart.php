<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id', 'users_id','quantity'
    ];

    // untuk menentukan kolom-kolom mana yang tidak akan ditampilkan ketika model dikonversi menjadi array atau respons JSON.
    protected $hidden = [
        
    ];
    // public function user(){
    //     return $this->hasOne( User::class, 'id', 'users_id');
    // }
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id'); //  artiny hasOne setiap keranjang memiliki 1 produk atau banyak produk
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id'); //  artiny hasOne setiap keranjang memiliki 1 produk atau banyak produk
        
    }
}
