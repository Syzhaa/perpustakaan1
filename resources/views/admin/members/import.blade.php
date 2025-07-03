@extends('layouts.admin')
{{-- Sesuaikan dengan layout admin-mu --}}

@section('content')
    <div class="container">
        <h1>Import Anggota</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.members.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">File Excel (.xlsx, .xls, .csv)</label>
                <input type="file" name="file" id="file" class="form-control" required>
                @error('file')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Import</button>
            <a href="/contoh-import-anggota.xlsx" class="btn btn-link" download>Download Contoh Format</a>
        </form>
    </div>
@endsection
