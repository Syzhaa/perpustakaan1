import React from 'react';
import { Link } from '@inertiajs/react';

export default function AdminLayout({ children }) {
    return (
        <div className="min-h-screen bg-gray-100">
            <header className="bg-blue-600 text-white p-4">
                <h1 className="text-xl font-bold">Admin Panel</h1>
                <nav className="mt-2 space-x-4">
                    <Link href={route('admin.dashboard')} className="hover:underline">Dashboard</Link>
                    <Link href={route('admin.books.index')} className="hover:underline">Buku</Link>
                    {/* <Link href={route('admin.members.index')} className="hover:underline">Anggota</Link>
                    <Link href={route('admin.peminjaman.index')} className="hover:underline">Peminjaman</Link> */}
                </nav>
            </header>
            <main className="p-4">
                {children}
            </main>
        </div>
    );
}
