<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'nama_makanan',
        'jenis_makanan',
        'harga',
        'deskripsi',
        'is_tersedia',
    ];
}
