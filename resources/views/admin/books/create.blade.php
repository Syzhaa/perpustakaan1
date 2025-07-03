@extends('layouts.admin')

@section('title', 'Tambah Buku Baru')

@section('content')

    <style>
        .form-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .form-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 1.5rem;
            display: flex;
            align-items: center;
        }

        .form-card .card-header i {
            font-size: 1.25rem;
            margin-right: 10px;
            color: #0d6efd;
        }

        .form-card .card-title {
            margin-bottom: 0;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .form-card .card-body {
            padding: 2rem;
        }

        .form-card .form-control,
        .form-card .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .form-card .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
        }

        .form-card .card-footer {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-top: 1px solid #f0f0f0;
            text-align: right;
        }

        .form-card .btn i {
            margin-right: 5px;
        }

        /* Style untuk pesan error */
        .invalid-feedback {
            display: block;
            /* Selalu tampilkan pesan error jika ada */
        }
    </style>

    <div class="card form-card">
        <div class="card-header">
            <i class="fas fa-plus-circle"></i>
            <h3 class="card-title">Tambah Buku Baru</h3>
        </div>

        {{-- Menampilkan daftar error di bagian atas jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-0 mx-4 mt-4 rounded-3">
                <h5 class="alert-heading">Terdapat Kesalahan!</h5>
                <p>Harap periksa kembali isian form Anda.</p>
            </div>
        @endif

        <form action="{{ route('admin.books.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row g-3">
                    {{-- Kolom Kiri --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis"
                                name="penulis" value="{{ old('penulis') }}" required>
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
                                id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
                            @error('penerbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror"
                                id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}"
                                placeholder="Contoh: 2023">
                            @error('tahun_terbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok"
                                name="stok" value="{{ old('stok') }}" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Buku
                </button>
            </div>
        </form>
    </div>
@endsection
