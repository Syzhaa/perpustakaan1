<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung Statistik Card
        $jumlahBuku = Book::count();
        $jumlahAnggota = User::where('role', 'anggota')->count();
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahBukuDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        // --- LOGIKA UNTUK BUKU TERLAMBAT (Digabungkan) ---
        $peminjamanTerlambat = Peminjaman::with(['user', 'book'])
            ->where('status', 'dipinjam')
            ->where('tanggal_peminjaman', '<', Carbon::now()->subDays(7))
            ->get();

        $jumlahTerlambat = $peminjamanTerlambat->count();
        // --- AKHIR LOGIKA BUKU TERLAMBAT ---

        // 2. Mengumpulkan Aktivitas Terbaru (dari beberapa tabel)
        $aktivitas = collect();

        // Ambil 5 peminjaman terbaru
        $peminjamanTerbaru = Peminjaman::with(['user', 'book'])->latest()->take(5)->get();
        foreach ($peminjamanTerbaru as $item) {
            $aktivitas->push((object)[
                'type' => 'pinjam',
                'description' => "<b>{$item->user->name}</b> meminjam buku <i>\"{$item->book->judul}\"</i>.",
                'time' => Carbon::parse($item->created_at)->diffForHumans(),
                'timestamp' => $item->created_at
            ]);
        }

        // Ambil 5 pengembalian terbaru
        $pengembalianTerbaru = Peminjaman::with(['user', 'book'])->where('status', 'dikembalikan')->latest('updated_at')->take(5)->get();
        foreach ($pengembalianTerbaru as $item) {
            $aktivitas->push((object)[
                'type' => 'kembali',
                'description' => "<b>{$item->user->name}</b> mengembalikan buku <i>\"{$item->book->judul}\"</i>.",
                'time' => Carbon::parse($item->updated_at)->diffForHumans(),
                'timestamp' => $item->updated_at
            ]);
        }

        // Ambil 5 anggota baru
        $anggotaBaru = User::where('role', 'anggota')->latest()->take(5)->get();
        foreach ($anggotaBaru as $item) {
            $aktivitas->push((object)[
                'type' => 'user_baru',
                'description' => "Pengguna baru <b>{$item->name}</b> telah terdaftar.",
                'time' => Carbon::parse($item->created_at)->diffForHumans(),
                'timestamp' => $item->created_at
            ]);
        }

        // Ambil 5 buku baru
        $bukuBaru = Book::latest()->take(5)->get();
        foreach ($bukuBaru as $item) {
            $aktivitas->push((object)[
                'type' => 'buku_baru',
                'description' => "Buku baru <i>\"{$item->judul}\"</i> telah ditambahkan.",
                'time' => Carbon::parse($item->created_at)->diffForHumans(),
                'timestamp' => $item->created_at
            ]);
        }

        // Urutkan semua aktivitas berdasarkan waktu dan ambil 5 teratas
        $aktivitasTerbaru = $aktivitas->sortByDesc('timestamp')->take(5);

        // 3. Kirim semua data ke view
        return view('admin.dashboard', [
            'jumlahBuku' => $jumlahBuku,
            'jumlahAnggota' => $jumlahAnggota,
            'jumlahPeminjaman' => $jumlahPeminjaman,
            'jumlahBukuDipinjam' => $jumlahBukuDipinjam,
            'jumlahTerlambat' => $jumlahTerlambat, // Variabel baru untuk notifikasi
            'peminjamanTerlambat' => $peminjamanTerlambat, // Variabel baru untuk daftar
            'aktivitasTerbaru' => $aktivitasTerbaru,
        ]);
    }
}
