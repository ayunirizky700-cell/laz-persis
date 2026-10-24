<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- Gunakan flexbox untuk membagi layar jadi kiri (sidebar) dan kanan (konten) -->
    <div class="flex h-screen bg-gray-100 overflow-hidden">

        <!-- ================= SIDEBAR KIRI ================= -->
        <aside class="w-64 bg-slate-800 text-white flex flex-col hidden md:flex">
            <!-- Logo / Judul -->
            <div class="h-16 flex items-center justify-center border-b border-slate-700">
                <span class="text-xl font-bold tracking-wider">LAZ PERSIS</span>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="/dashboard" class="block px-4 py-2 rounded-lg bg-slate-700 hover:bg-slate-600 transition">🏠
                    Dashboard</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-slate-600 transition">👥 Data Muzakki</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-slate-600 transition">🤝 Data Mustahik</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-slate-600 transition">💵 Penerimaan</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-slate-600 transition">💸 Penyaluran</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-slate-600 transition">📋 Laporan</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-slate-600 transition">⚙️ Pengaturan</a>
            </nav>
        </aside>

        <!-- ================= KONTEN KANAN ================= -->
        <div class="flex-1 flex flex-col overflow-y-auto">

            <!-- Navbar Atas (Logout, Profile) -->
            @include('layouts.navigation')

            <!-- Header Halaman (Jika ada) -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Isi Konten Utama -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>

</html>