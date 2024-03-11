<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = [
        'photos', 'products_id'
    ];

    protected $hidden = [

    ];

    public function product(){
         //mendefinisikan bahwa satu ProductGallery hanya bisa dimiliki oleh satu Product. Ini diwakili oleh relasi belongsTo. 
         // Parameter pertama adalah model yang berelasi (Product::class), parameter kedua adalah foreign key di tabel product_galleries ('products_id'), dan parameter ketiga adalah primary key di tabel products ('id')
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
