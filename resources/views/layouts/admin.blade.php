<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Perpustakaan')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Select2 CSS (jika diperlukan di banyak halaman) --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <style>
        body {
            background-color: #f4f7f6;
            /* Warna latar yang lebih lembut */
        }

        /* Memberi ruang untuk sidebar tetap di sebelah kiri */
        .main-content {
            margin-left: 260px;
            /* Sesuaikan dengan lebar sidebar Anda */
            transition: margin-left 0.3s ease;
        }

        /* Konten utama di dalam .main-content */
        .content-wrapper {
            padding: 1.5rem;
        }

        /* Styling untuk alert */
        .alert {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    {{-- Memanggil komponen Sidebar --}}
    <x-sidebar />

    {{-- Konten utama halaman --}}
    <div class="main-content">
        {{-- Memanggil komponen Navbar --}}
        <x-navbar />

        <main class="content-wrapper">
            {{-- Menampilkan notifikasi sukses jika ada --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Menampilkan notifikasi error jika ada --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Tempat untuk konten dari setiap halaman --}}
            @yield('content')
        </main>
    </div>

    {{-- JavaScript Libraries --}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Tempat untuk script spesifik per halaman --}}
    @stack('scripts')

</body>

</html>
