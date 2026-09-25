<x-app-layout>
    <!-- Slot Header (Bawaan Laravel) -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard LAZ PERSIS') }}
        </h2>
    </x-slot>

    <!-- Memanggil ikon FontAwesome dari CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ================= RESET & DASAR ================= */
        .dashboard-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* ================= BANNER SELAMAT DATANG ================= */
        .welcome-banner {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .welcome-banner h1 {
            font-size: 26px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .welcome-banner p {
            font-size: 15px;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .badge-active {
            background-color: #28a745;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* ================= GRID KARTU STATISTIK ================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-title {
            font-size: 13px;
            color: #6c757d;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
        }

        /* ================= WARNA IKON & ANGKA ================= */
        .icon-blue {
            background-color: #e6f0ff;
            color: #0d6efd;
        }

        .text-blue {
            color: #0d6efd;
        }

        .icon-red {
            background-color: #ffe6e6;
            color: #dc3545;
        }

        .text-red {
            color: #dc3545;
        }

        .icon-yellow {
            background-color: #fff8e1;
            color: #ffc107;
        }

        .text-yellow {
            color: #ffc107;
        }

        .icon-green {
            background-color: #e8f5e9;
            color: #198754;
        }

        .text-green {
            color: #198754;
        }

        /* Bentuk Lingkaran Ikon */
        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
        }
    </style>

    <!-- Konten Utama Dashboard -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dashboard-container">

                <!-- Banner Selamat Datang -->
                <div class="welcome-banner">
                    <h3>Selamat Datang, {{ Auth::user()->nama ?? Auth::user()->name }}! 👋</h3>
                    Anda login sebagai {{ Auth::user()->role->nama_role ?? 'User' }}
                    <p class="status">Status akun: <span class="badge-active">aktif</span></p>

                    <!-- Waktu Bergabung (Menggunakan Teks Manual/Statis) -->
                    <p><i class="fa-regular fa-calendar-check"></i> Waktu Bergabung: 24 September 2026</p>

                </div>

                <!-- Grid Kartu Statistik -->
                <div class="stats-grid">

                    <!-- Kartu 1: Total Pengguna -->
                    <div class="stat-card">
                        <div class="stat-info">
                            <p class="stat-title">TOTAL PENGGUNA</p>
                            <h3 class="stat-number text-blue">3</h3>
                        </div>
                        <div class="stat-icon icon-blue">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>

                    <!-- Kartu 2: Super Admin -->
                    <div class="stat-card">
                        <div class="stat-info">
                            <p class="stat-title">SUPER ADMIN</p>
                            <h3 class="stat-number text-red">1</h3>
                        </div>
                        <div class="stat-icon icon-red">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                    </div>

                    <!-- Kartu 3: Pimpinan -->
                    <div class="stat-card">
                        <div class="stat-info">
                            <p class="stat-title">PIMPINAN</p>
                            <h3 class="stat-number text-yellow">1</h3>
                        </div>
                        <div class="stat-icon icon-yellow">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                    </div>

                    <!-- Kartu 4: Amil -->
                    <div class="stat-card">
                        <div class="stat-info">
                            <p class="stat-title">AMIL</p>
                            <h3 class="stat-number text-green">1</h3>
                        </div>
                        <div class="stat-icon icon-green">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>