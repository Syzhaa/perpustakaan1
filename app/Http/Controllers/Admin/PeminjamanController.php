<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar semua transaksi peminjaman.
     */
    public function index()
    {
        // Ambil data peminjaman dengan relasi user dan buku (Eager Loading)
        // Diurutkan dari yang terbaru dan diberi paginasi
        $peminjamans = Peminjaman::with(['user', 'book'])
            ->latest()
            ->paginate(10);

        // Kirim data ke view
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Menampilkan form untuk membuat peminjaman baru.
     */
    public function create()
    {
        // Mengambil semua user dengan role 'anggota'
        $members = User::where('role', 'anggota')->get();

        // Mengambil semua buku yang stoknya masih ada
        $books = Book::where('stok', '>', 0)->get();

        return view('admin.peminjaman.create', compact('members', 'books'));
    }

    /**
     * Menyimpan data peminjaman baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        Peminjaman::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'tanggal_peminjaman' => now(),
            'status' => 'dipinjam',
        ]);

        // Kurangi stok buku yang dipinjam
        $book = Book::find($request->book_id);
        $book->decrement('stok');

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Transaksi peminjaman berhasil ditambahkan.');
    }
    public function kembalikan(Peminjaman $peminjaman)
    {
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_pengembalian' => now(),
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');
    }


    // Anda bisa menambahkan method untuk pengembalian di sini nanti
}
