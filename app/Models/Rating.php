<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai database
    protected $table = 'rating';  // ← tambahkan ini, karena default Laravel akan menambahkan "s" di akhir

    protected $fillable = [
        'user_id',
        'produk_id',
        'stars',    // sesuai field di tabel
        'comment',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Produk::class, 'produk_id'); // pastikan foreign key sesuai
    }
}
