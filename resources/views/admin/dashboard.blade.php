@extends('layouts.admin')

@section('content')
    {{-- Font Awesome & CSS Kustom (Sama seperti sebelumnya) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        .stat-card { border: none; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.07); transition: all 0.3s ease; color: #fff; overflow: hidden; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .stat-card .card-body { display: flex; align-items: center; justify-content: space-between; padding: 20px 25px; position: relative; z-index: 2; }
        .stat-card .stat-icon { font-size: 3.5rem; opacity: 0.2; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
        .stat-card .stat-info h5 { font-size: 0.95rem; font-weight: 600; margin-bottom: 5px; text-transform: uppercase; }
        .stat-card .stat-info .stat-number { font-size: 2.5rem; font-weight: 700; line-height: 1; }
        .bg-card-1 { background: linear-gradient(135deg, #007bff, #0056b3); }
        .bg-card-2 { background: linear-gradient(135deg, #28a745, #1e7e34); }
        .bg-card-3 { background: linear-gradient(135deg, #17a2b8, #117a8b); }
        .bg-card-danger { background: linear-gradient(135deg, #dc3545, #b21f2d); }
    </style>

    <div class="container-fluid">
        <h1 class="mb-4">Dashboard Admin</h1>

        {{-- BAGIAN BARU: Notifikasi Peminjaman Terlambat --}}
        @if($jumlahTerlambat > 0)
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
            <div>
                <strong>Perhatian!</strong> Terdapat <strong>{{ $jumlahTerlambat }} buku</strong> yang terlambat dikembalikan lebih dari 7 hari.
            </div>
        </div>
        @endif
        
        <div class="row">
            {{-- Card Statistik --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-card-1">
                    <div class="card-body">
                        <div class="stat-info"><h5>Jumlah Buku</h5><span class="stat-number">{{ $jumlahBuku }}</span></div>
                        <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-card-2">
                    <div class="card-body">
                        <div class="stat-info"><h5>Jumlah Anggota</h5><span class="stat-number">{{ $jumlahAnggota }}</span></div>
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-card-3">
                    <div class="card-body">
                        <div class="stat-info"><h5>Buku Dipinjam</h5><span class="stat-number">{{ $jumlahBukuDipinjam }}</span></div>
                        <div class="stat-icon"><i class="fas fa-book-reader"></i></div>
                    </div>
                </div>
            </div>
            {{-- CARD BARU: Buku Terlambat --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-card-danger">
                    <div class="card-body">
                        <div class="stat-info"><h5>Buku Terlambat</h5><span class="stat-number">{{ $jumlahTerlambat }}</span></div>
                        <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN BARU: Daftar Peminjaman Terlambat --}}
        @if(!$peminjamanTerlambat->isEmpty())
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-list-ul me-2"></i>Daftar Peminjaman Terlambat</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Peminjam</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Terlambat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjamanTerlambat as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->user->name ?? 'N/A' }}</td>
                                    <td>{{ $peminjaman->book->judul ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-danger">
                                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->addDays(7)->diffForHumans() }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

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
        </div>{{-- Aktivitas Terbaru (Sama seperti sebelumnya) --}}
        {{-- ... kode untuk aktivitas terbaru bisa diletakkan di sini ... --}}
    </div>
@endsection
