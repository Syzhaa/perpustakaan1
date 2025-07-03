<style>
    /* CSS untuk Navbar Modern */
    .admin-navbar {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        padding: 0.75rem 1.5rem;
    }

    .admin-navbar .navbar-nav .nav-link {
        color: #555;
    }

    .admin-navbar .dropdown-menu {
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .admin-navbar .dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        color: #333;
        transition: background-color 0.2s ease;
    }

    .admin-navbar .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .admin-navbar .dropdown-item i {
        margin-right: 12px;
        width: 20px;
        text-align: center;
        color: #888;
    }

    .admin-navbar .dropdown-divider {
        margin: 0.5rem 0;
    }

    .admin-navbar .dropdown-item.text-danger:hover {
        background-color: #fdf2f2;
        color: #dc3545 !important;
    }
</style>

<nav class="navbar navbar-expand-lg admin-navbar">
    <div class="container-fluid">
        {{-- Bagian kiri bisa untuk breadcrumbs atau judul halaman --}}
        <a class="navbar-brand" href="#">Dashboard</a>

        {{-- Tombol toggler untuk mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbarContent"
            aria-controls="adminNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbarContent">
            {{-- Profil Pengguna di sebelah kanan, tanpa dropdown --}}
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ Auth::user()->name ?? 'User' }}
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
