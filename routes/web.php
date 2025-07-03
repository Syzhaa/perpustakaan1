<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PeminjamanController;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

// Dashboard Semua User Login
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard'); // Dashboard untuk anggota biasa
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Profile User Login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================================================================
// == GRUP ROUTE KHUSUS UNTUK ADMIN (Blade) ==
// =====================================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    // --- Manajemen Buku ---
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // --- Manajemen Anggota ---
    Route::resource('members', MemberController::class);
    Route::get('members/import/form', [MemberController::class, 'showImportForm'])->name('members.import.form');
    Route::post('members/import', [MemberController::class, 'import'])->name('members.import');

    // --- Fitur Peminjaman ---
    Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::patch('peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');


    Route::get('/books/import', [BookController::class, 'showImportForm'])->name('books.import.form');
    Route::post('/books/import', [BookController::class, 'import'])->name('books.import');
    // Contoh route untuk pengembalian (opsional)
    // Route::patch('peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
});

require __DIR__ . '/auth.php';
