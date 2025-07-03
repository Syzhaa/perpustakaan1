import React from 'react';
import { Head } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <>
            <Head title="Dashboard Admin" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h1 className="text-2xl font-bold mb-4">Selamat Datang di Dashboard Admin</h1>
                            <p>Anda login sebagai <strong>Admin</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
