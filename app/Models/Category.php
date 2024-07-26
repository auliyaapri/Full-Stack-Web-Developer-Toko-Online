<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;
    use HasFactory;

    // Menentukan kolom yang diizinkan untuk diisi secara massal.
    protected $fillable = [
        'name', 'photo', 'slug'
    ];

    // untuk menentukan kolom-kolom mana yang tidak akan ditampilkan ketika model dikonversi menjadi array atau respons JSON.
    protected $hidden = [
        'password'
    ];

    public function user(): HasMany {
        return $this->hasMany(User::class, 'categories_id');
    }
    
}


