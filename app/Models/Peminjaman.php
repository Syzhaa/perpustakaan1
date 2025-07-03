<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    /**
     * Secara eksplisit memberitahu Laravel untuk menggunakan nama tabel 'peminjamans'
     * karena tebakan defaultnya (peminjamen) salah.
     */
    protected $table = 'peminjamans';

    /**
     * Kolom-kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status',
    ];

    /**
     * Relasi ke model User (peminjam).
     * Setiap peminjaman dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Book (buku yang dipinjam).
     * Setiap peminjaman terkait dengan satu buku.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
