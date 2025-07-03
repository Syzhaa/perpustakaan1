<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Ini untuk mengizinkan field mana saja yang boleh diisi secara massal (lewat create atau update)
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];

    /**
     * Mendefinisikan relasi "satu buku bisa dimiliki banyak transaksi peminjaman".
     */
    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }
}
