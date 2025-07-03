<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MembersImport;

class MemberController extends Controller
{
    /**
     * Menampilkan daftar semua anggota.
     */
    public function index()
    {
        $members = User::where('role', 'anggota')->latest()->paginate(10);
        return view('admin.members.index', compact('members'));
    }

    /**
     * Menampilkan form untuk menambah anggota baru.
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Menyimpan anggota baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Anggota baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data anggota.
     */
    public function edit(User $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Mengupdate data anggota di database.
     */
    public function update(Request $request, User $member)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $member->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $dataToUpdate = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $member->update($dataToUpdate);

        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Menghapus data anggota dari database.
     */
    public function destroy(User $member)
    {
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil dihapus.');
    }

    /**
     * Menampilkan halaman form untuk impor anggota.
     */
    public function showImportForm()
    {
        return view('admin.members.import');
    }

    /**
     * Memproses file Excel yang diimpor.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new MembersImport, $request->file('file'));

        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil diimpor!');
    }
}
