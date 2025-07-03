@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Manajemen Anggota</h1>
        <div>
            <a href="{{ route('admin.members.import.form') }}" class="btn btn-success">Impor dari Excel</a>
            <a href="{{ route('admin.members.create') }}" class="btn btn-primary">Tambah Anggota Baru</a>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Tanggal Bergabung</th>
                <th scope="col" style="width: 15%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $members->links() }}
    </div>
@endsection
