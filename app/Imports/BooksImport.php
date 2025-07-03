<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    /**
     * Proses setiap baris di Excel.
     */
    public function model(array $row)
    {
        // Cek apakah sudah ada di database (misalnya berdasarkan judul & penulis)
        $exists = Book::where('judul', $row['judul'])
            ->where('penulis', $row['penulis'])
            ->exists();

        if ($exists) {
            // Data sudah ada, skip.
            return null;
        }

        // Simpan jika belum ada
        return new Book([
            'judul' => $row['judul'],
            'penulis' => $row['penulis'],
            'penerbit' => $row['penerbit'] ?? null,
            'tahun_terbit' => $row['tahun_terbit'] ?? null,
            'stok' => $row['stok'] ?? 0,
        ]);
    }
}
