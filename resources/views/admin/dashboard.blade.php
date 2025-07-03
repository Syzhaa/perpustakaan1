@extends('layouts.admin')

@section('content')
    {{-- Saya sarankan untuk menempatkan link Font Awesome di layout utama Anda (misal: layouts/admin.blade.php) 
         agar tidak perlu memuatnya di setiap halaman. Namun, untuk contoh ini, saya letakkan di sini. --}}

    <style>
        /* CSS Kustom untuk tampilan yang lebih modern */
        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #fff;
            overflow: hidden;
            /* Untuk memastikan gradien tidak tumpah */
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 25px;
            position: relative;
            z-index: 2;
        }

        .stat-card .stat-icon {
            font-size: 3.5rem;
            opacity: 0.2;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            transition: opacity 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            opacity: 0.3;
        }

        .stat-card .stat-info h5 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .stat-info .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
        }

        /* Skema warna gradien */
        .bg-card-1 {
            background: linear-gradient(135deg, #007bff, #0056b3);
        }

        .bg-card-2 {
            background: linear-gradient(135deg, #28a745, #1e7e34);
        }

        .bg-card-3 {
            background: linear-gradient(135deg, #ffc107, #d39e00);
        }

        .bg-card-4 {
            background: linear-gradient(135deg, #17a2b8, #117a8b);
        }

        .bg-card-5 {
            background: linear-gradient(135deg, #dc3545, #b21f2d);
        }

        /* CSS untuk daftar aktivitas */
        .activity-list .list-group-item {
            border: none;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-list .list-group-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .activity-content {
            flex-grow: 1;
        }

        .activity-content p {
            margin-bottom: 0;
            line-height: 1.4;
            color: #333;
        }

        .activity-content .activity-time {
            font-size: 0.8rem;
            color: #888;
        }

        .icon-pinjam {
            background-color: #17a2b8;
        }

        .icon-kembali {
            background-color: #28a745;
        }

        .icon-user {
            background-color: #007bff;
        }

        .icon-buku {
            background-color: #6f42c1;
        }
    </style>

    <div class="container-fluid">

        <div class="row">
            <!-- Card Jumlah Buku -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card stat-card bg-card-1">
                    <div class="card-body">
                        <div class="stat-info">
                            <h5>Jumlah Buku</h5>
                            <span class="stat-number">{{ $jumlahBuku }}</span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Jumlah Anggota -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card stat-card bg-card-2">
                    <div class="card-body">
                        <div class="stat-info">
                            <h5>Jumlah Anggota</h5>
                            <span class="stat-number">{{ $jumlahAnggota }}</span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Jumlah Peminjaman -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card stat-card bg-card-3">
                    <div class="card-body">
                        <div class="stat-info text-dark">
                            <h5>Total Peminjaman</h5>
                            <span class="stat-number">{{ $jumlahPeminjaman }}</span>
                        </div>
                        <div class="stat-icon text-dark">
                            <i class="fas fa-handshake"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Buku Sedang Dipinjam -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card stat-card bg-card-4">
                    <div class="card-body">
                        <div class="stat-info">
                            <h5>Buku Sedang Dipinjam</h5>
                            <span class="stat-number">{{ $jumlahBukuDipinjam }}</span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Buku Belum Dikembalikan -->
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card stat-card bg-card-5">
                    <div class="card-body">
                        <div class="stat-info">
                            <h5>Buku Belum Kembali</h5>
                            <span class="stat-number">{{ $jumlahBelumDikembalikan }}</span>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bagian Aktivitas Terbaru --}}
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-history mr-2"></i>Aktivitas Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        {{-- 
                            Anda perlu mengirimkan variabel $aktivitasTerbaru dari controller Anda.
                            Variabel ini harus berupa array/collection dari objek aktivitas.
                            Contoh data:
                            $aktivitasTerbaru = [
                                (object)['type' => 'pinjam', 'description' => 'Andi meminjam buku "Laskar Pelangi".', 'time' => '5 menit yang lalu'],
                                (object)['type' => 'kembali', 'description' => 'Budi mengembalikan buku "Bumi Manusia".', 'time' => '1 jam yang lalu'],
                                (object)['type' => 'user_baru', 'description' => 'Pengguna baru "Citra" telah terdaftar.', 'time' => '3 jam yang lalu'],
                                (object)['type' => 'buku_baru', 'description' => 'Buku baru "Negeri 5 Menara" ditambahkan.', 'time' => '1 hari yang lalu'],
                            ];
                        --}}
                        @if (isset($aktivitasTerbaru) && count($aktivitasTerbaru) > 0)
                            <ul class="list-group list-group-flush activity-list">
                                @foreach ($aktivitasTerbaru as $aktivitas)
                                    <li class="list-group-item">
                                        @switch($aktivitas->type)
                                            @case('pinjam')
                                                <div class="activity-icon icon-pinjam"><i class="fas fa-arrow-circle-up"></i></div>
                                            @break

                                            @case('kembali')
                                                <div class="activity-icon icon-kembali"><i class="fas fa-arrow-circle-down"></i>
                                                </div>
                                            @break

                                            @case('user_baru')
                                                <div class="activity-icon icon-user"><i class="fas fa-user-plus"></i></div>
                                            @break

                                            @case('buku_baru')
                                                <div class="activity-icon icon-buku"><i class="fas fa-book"></i></div>
                                            @break

                                            @default
                                                <div class="activity-icon bg-secondary"><i class="fas fa-info-circle"></i></div>
                                        @endswitch
                                        <div class="activity-content">
                                            <p>{!! $aktivitas->description !!}</p>
                                            <span class="activity-time">{{ $aktivitas->time }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-center text-muted p-4">Belum ada aktivitas terbaru.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
