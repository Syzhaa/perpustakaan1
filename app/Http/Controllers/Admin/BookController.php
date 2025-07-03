<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

// Tambahan untuk Impor Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku dengan fungsionalitas pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mulai query builder
        $books = Book::query()
            ->when($search, function ($query, $search) {
                // Jika ada input pencarian, filter berdasarkan judul atau penulis
                return $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%");
            })
            ->latest() // Urutkan berdasarkan yang terbaru
            ->paginate(10); // Paginasi hasil

        // Mengembalikan view dengan data buku dan query pencarian
        return view('admin.books.index', compact('books', 'search'));
    }


    /**
     * Menampilkan form untuk menambah buku baru.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Menyimpan data buku baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . date('Y'),
            'stok' => 'required|integer|min:0',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data buku.
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Mengupdate data buku di database.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . date('Y'),
            'stok' => 'required|integer|min:0',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menghapus data buku dari database.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    /**
     * Menampilkan halaman form untuk impor data buku.
     */
    public function showImportForm()
    {
        return view('admin.books.import');
    }

    /**
     * Memproses file Excel yang diimpor.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new BooksImport, $request->file('file'));

        return redirect()->route('admin.books.index')->with('success', 'Data buku berhasil diimpor!');
    }
}
