<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Fungsi ini akan dijalankan untuk setiap baris data di Excel.
        // Pastikan heading di file Excel Anda adalah 'nama', 'email', dan 'password'.
        return new User([
            'name'     => $row['nama'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']), // Password langsung di-hash
            'role'     => 'anggota', // Role dikunci hanya untuk 'anggota'
        ]);
    }
}
