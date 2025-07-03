{{-- resources/views/components/admin-sidebar.blade.php --}}

{{-- 
  Komponen Sidebar Admin Modern.
  Komponen ini secara otomatis akan menandai link yang aktif berdasarkan route saat ini.
--}}

<style>
    /* CSS untuk Sidebar Modern */
    .admin-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        /* Tinggi penuh viewport */
        width: 260px;
        background: #2c3e50;
        /* Warna dasar gelap */
        background: linear-gradient(180deg, #3a506b, #1c2833);
        /* Gradien halus */
        padding: 20px 0;
        transition: all 0.3s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        /* Mengatur item secara vertikal */
        box-shadow: 3px 0px 15px rgba(0, 0, 0, 0.2);
    }

    .admin-sidebar .sidebar-header {
        padding: 0 25px;
        margin-bottom: 30px;
        text-align: center;
    }

    .admin-sidebar .sidebar-header a {
        color: #fff;
        font-size: 1.6rem;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .admin-sidebar .sidebar-header i {
        margin-right: 10px;
        color: #1abc9c;
        /* Warna aksen */
    }

    .admin-sidebar .nav-links {
        list-style: none;
        padding: 0;
        margin: 0;
        flex-grow: 1;
        /* Membuat nav-links mengisi ruang yang tersedia */
    }

    .admin-sidebar .nav-links li a {
        display: flex;
        align-items: center;
        padding: 15px 25px;
        color: #e0e0e0;
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .admin-sidebar .nav-links li a:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
        border-left-color: #1abc9c;
    }

    /* Kelas 'active' untuk link yang sedang aktif */
    .admin-sidebar .nav-links li a.active {
        background: #1abc9c;
        color: #fff;
        font-weight: 500;
        border-left-color: #fff;
    }

    .admin-sidebar .nav-links li a i {
        font-size: 1.1rem;
        width: 25px;
        /* Memberi ruang yang konsisten untuk ikon */
        margin-right: 15px;
        text-align: center;
    }

    .admin-sidebar .sidebar-footer {
        padding: 20px 25px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Menghilangkan styling default dari button di dalam form */
    .logout-form button {
        padding: 0;
        border: none;
        background: none;
        width: 100%;
    }
</style>

<div class="admin-sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fas fa-shield-alt"></i>
            <span>AdminPanel</span>
        </a>
    </div>

    <ul class="nav-links">
        <li>
            {{-- Mengecek apakah route saat ini adalah 'admin.dashboard' --}}
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            {{-- Mengecek apakah route saat ini diawali dengan 'admin.books.*' (misal: admin.books.index, admin.books.create) --}}
            <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                <i class="fas fa-book"></i>
                <span>Manajemen Buku</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.members.index') }}"
                class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Manajemen Anggota</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.peminjaman.index') }}"
                class="{{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                <i class="fas fa-exchange-alt"></i>
                <span>Peminjaman</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        {{-- Tombol logout sekarang berada di dalam form untuk mengirim request POST --}}
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>
</div>
