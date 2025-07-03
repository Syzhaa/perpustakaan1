@extends('layouts.admin')

@section('content')
    <h1>Form Peminjaman Buku</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.peminjaman.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Pilih Anggota</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="" disabled selected>-- Nama Anggota --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="book_id" class="form-label">Pilih Buku</label>
            <select name="book_id" id="book_id" class="form-select" required>
                <option value="" disabled selected>-- Judul Buku --</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->judul }} - (Stok: {{ $book->stok }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
        <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#user_id').select2({
                placeholder: "Cari Anggota...",
                allowClear: true
            });

            $('#book_id').select2({
                placeholder: "Cari Buku...",
                allowClear: true
            });
        });
    </script>
@endpush
