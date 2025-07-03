@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Data Peminjaman Buku</h1>
        <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-primary">Buat Peminjaman Baru</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Batas Pengembalian</th> {{-- KOLOM BARU --}}
                <th scope="col">Tanggal Kembali</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamans as $peminjaman)
                <tr>
                    <th scope="row">{{ ($peminjamans->currentPage() - 1) * $peminjamans->perPage() + $loop->iteration }}
                    </th>
                    <td>{{ $peminjaman->user->name ?? 'User Dihapus' }}</td>
                    <td>{{ $peminjaman->book->judul ?? 'Buku Dihapus' }}</td>
                    <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d M Y') }}</td>

                    {{-- Menampilkan batas tanggal pengembalian (7 hari setelah pinjam) --}}
                    <td>
                        @php
                            $batasPengembalian = \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->addDays(7);
                            $isTerlambat = $peminjaman->status == 'dipinjam' && now()->gt($batasPengembalian);
                        @endphp
                        <span class="{{ $isTerlambat ? 'text-danger fw-bold' : '' }}">
                            {{ $batasPengembalian->format('d M Y') }}
                        </span>
                    </td>

                    {{-- Menampilkan tanggal kembali jika statusnya sudah dikembalikan --}}
                    <td>
                        @if ($peminjaman->status == 'dikembalikan' && $peminjaman->tanggal_pengembalian)
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if ($peminjaman->status == 'dipinjam')
                            <span class="badge {{ $isTerlambat ? 'bg-danger' : 'bg-warning text-dark' }}">
                                {{ $isTerlambat ? 'Terlambat' : 'Dipinjam' }}
                            </span>
                        @else
                            <span class="badge bg-success">Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        @if ($peminjaman->status == 'dipinjam')
                            {{-- Tombol ini memerlukan route dan method controller tambahan --}}
                            <form action="{{ route('admin.peminjaman.kembalikan', $peminjaman->id) }}" method="POST"
                                onsubmit="return confirm('Yakin buku ini sudah dikembalikan?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Tandai Kembali</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    {{-- colspan diubah menjadi 8 karena ada kolom baru --}}
                    <td colspan="8" class="text-center">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $peminjamans->links() }}
    </div>
@endsection
