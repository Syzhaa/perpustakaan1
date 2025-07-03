@extends('layouts.admin')

@section('content')
    <style>
        .book-management-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .book-management-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .book-management-card .card-title {
            margin-bottom: 0;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .book-management-card .card-body {
            padding: 1.5rem;
        }

        .book-management-card .table thead th {
            background-color: #f8f9fa;
            border-bottom-width: 1px;
            font-weight: 600;
            color: #343a40;
        }

        .book-management-card .table td,
        .book-management-card .table th {
            vertical-align: middle;
        }

        .book-management-card .table-hover tbody tr:hover {
            background-color: #f1f5f9;
        }

        .book-management-card .action-buttons .btn {
            margin-right: 5px;
        }

        .book-management-card .empty-state {
            padding: 4rem;
            text-align: center;
            color: #6c757d;
        }

        .book-management-card .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }

        .book-management-card .card-footer {
            background-color: #fff;
            border-top: 1px solid #f0f0f0;
        }
    </style>

    <div class="card book-management-card">
        <div class="card-header">
            <h3 class="card-title">Manajemen Buku</h3>
            <div class="d-flex">
                <a href="{{ route('admin.books.import.form') }}" class="btn btn-outline-success me-2">
                    <i class="fas fa-file-excel"></i> Impor
                </a>
                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Buku
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- Form Pencarian --}}
            <div class="mb-4">
                <form action="{{ route('admin.books.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari berdasarkan judul atau penulis..." value="{{ $search ?? '' }}">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Stok</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <th scope="row">{{ $loop->iteration + $books->firstItem() - 1 }}</th>
                                <td>{{ $book->judul }}</td>
                                <td>{{ $book->penulis }}</td>
                                <td>{{ $book->stok }}</td>
                                <td class="text-center action-buttons">
                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-warning"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Anda yakin ingin menghapus buku \'{{ $book->judul }}\'?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-search-minus"></i>
                                        @if (!empty($search))
                                            <h5>Buku Tidak Ditemukan</h5>
                                            <p>Tidak ada buku yang cocok dengan kata kunci "{{ $search }}".</p>
                                        @else
                                            <h5>Belum Ada Data Buku</h5>
                                            <p>Silakan tambahkan buku baru untuk memulai.</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($books->hasPages())
            <div class="card-footer d-flex justify-content-center">
                {{-- Menambahkan query pencarian ke link paginasi --}}
                {{ $books->appends(['search' => $search])->links() }}
            </div>
        @endif
    </div>
@endsection
