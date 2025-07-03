@extends('layouts.admin')

@section('title', 'Impor Buku dari Excel')

@section('content')

    <style>
        .import-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .import-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 1.5rem;
            display: flex;
            align-items: center;
        }

        .import-card .card-header i {
            font-size: 1.25rem;
            margin-right: 10px;
            color: #198754;
            /* Warna hijau untuk Excel */
        }

        .import-card .card-title {
            margin-bottom: 0;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .import-card .card-body {
            padding: 2rem;
        }

        .import-card .instructions {
            background-color: #eef7ff;
            border-left: 4px solid #0d6efd;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .import-card .instructions strong {
            font-family: monospace;
            background-color: rgba(0, 0, 0, 0.05);
            padding: 2px 5px;
            border-radius: 4px;
        }

        .import-card .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .import-card .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
        }

        .import-card .card-footer {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-top: 1px solid #f0f0f0;
            text-align: right;
        }

        .import-card .btn i {
            margin-right: 5px;
        }
    </style>

    <div class="card import-card">
        <div class="card-header">
            <i class="fas fa-file-excel"></i>
            <h3 class="card-title">Impor Buku dari Excel</h3>
        </div>

        <form action="{{ route('admin.books.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="instructions">
                    <h5 class="fw-bold">Petunjuk Format</h5>
                    <p class="mb-2">
                        Pastikan file Excel (.xlsx atau .xls) Anda memiliki format yang benar. Baris pertama (header) harus
                        berisi kolom dengan urutan sebagai berikut:
                    </p>
                    <p class="mb-2">
                        <strong>judul</strong>, <strong>penulis</strong>, <strong>penerbit</strong>,
                        <strong>tahun_terbit</strong>, dan <strong>stok</strong>.
                    </p>
                    <a href="{{ asset('templates/contoh-import-buku.xlsx') }}" class="btn btn-sm btn-outline-primary mt-2"
                        download>
                        <i class="fas fa-download"></i> Download Contoh Format
                    </a>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label fw-bold">Pilih File Excel</label>
                    <input class="form-control @error('file') is-invalid @enderror" type="file" id="file"
                        name="file" required accept=".xlsx, .xls">
                    @error('file')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-upload"></i> Impor Data
                </button>
            </div>
        </form>
    </div>
@endsection
