<x-app-layout>

    {{-- Tambahan CSS Khusus Dashboard agar dijamin rapi --}}
    <style>
        /* Mengatur Grid Layout */
        .dashboard-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
            margin-bottom: 20px;
        }

        .dashboard-col-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding-right: 15px;
            padding-left: 15px;
            box-sizing: border-box;
        }

        .dashboard-col-3 {
            flex: 0 0 25%;
            max-width: 25%;
            padding-right: 15px;
            padding-left: 15px;
            box-sizing: border-box;
        }

        /* Mengatur Kartu */
        .card-custom {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: transform 0.3s ease;
            height: 100%;
        }

        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Teks dan Warna */
        .text-label {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .text-value {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0;
        }

        .text-green {
            color: #198754;
        }

        .text-red {
            color: #dc3545;
        }

        .text-blue {
            color: #0d6efd;
        }

        .text-orange {
            color: #fd7e14;
        }

        /* Responsif untuk layar kecil (HP) */
        @media (max-width: 768px) {

            .dashboard-col-4,
            .dashboard-col-3 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 15px;
            }
        }
    </style>

    <div class="container-fluid">

        <!-- 1. Banner Sambutan -->
        <div class="card-custom mb-4"
            style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; border-radius: 15px;">
            <h3 class="fw-bold mb-2">Selamat Datang, {{ Auth::user()->nama ?? Auth::user()->name }}! 👋</h3>
            <p class="mb-0" style="opacity: 0.9;">
                Status Akun:
                <span style="background: #198754; padding: 3px 8px; border-radius: 5px; font-size: 0.8rem;">AKTIF</span>
                &nbsp;|&nbsp; Login sebagai:
                <strong>{{ Auth::user()->role_id == 1 ? 'Super Admin' : (Auth::user()->role_id == 2 ? 'Amil' : 'Pimpinan') }}</strong>
            </p>
        </div>

        <!-- 2. Kartu Keuangan (Paling Utama) -->
        <div class="dashboard-row">
            <!-- Penerimaan (Semua Role Boleh Lihat) -->
            <div class="dashboard-col-4">
                <div class="card-custom" style="border-left: 5px solid #198754;">
                    <div class="text-label">Total Penerimaan</div>
                    <div class="text-value text-green">Rp {{ number_format($totalPenerimaan, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Penyaluran (Semua Role Boleh Lihat) -->
            <div class="dashboard-col-4">
                <div class="card-custom" style="border-left: 5px solid #dc3545;">
                    <div class="text-label">Total Penyaluran</div>
                    <div class="text-value text-red">Rp {{ number_format($totalPenyaluran, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Saldo Akhir: HANYA Super Admin (1) dan Pimpinan (3) yang boleh lihat -->
            @if($role_id == 1 || $role_id == 3)
                <div class="dashboard-col-4">
                    <div class="card-custom" style="border-left: 5px solid #0d6efd;">
                        <div class="text-label">Saldo Akhir</div>
                        <div class="text-value text-blue">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                    </div>
                </div>
            @endif
        </div>

        <!-- 3. Statistik Pengguna: HANYA Super Admin (1) yang boleh lihat -->
        @if($role_id == 1)
            <h5 class="fw-bold mb-3 mt-4">Statistik Pengguna</h5>
            <div class="dashboard-row">
                <!-- Total Pengguna -->
                <div class="dashboard-col-3">
                    <div class="card-custom text-center">
                        <div class="text-value" style="color: #333;">{{ $totalPengguna }}</div>
                        <div class="text-label mt-2">Total Pengguna</div>
                    </div>
                </div>

                <!-- Super Admin -->
                <div class="dashboard-col-3">
                    <div class="card-custom text-center">
                        <div class="text-value text-red">{{ $totalSuperAdmin }}</div>
                        <div class="text-label mt-2">Super Admin</div>
                    </div>
                </div>

                <!-- Pimpinan -->
                <div class="dashboard-col-3">
                    <div class="card-custom text-center">
                        <div class="text-value text-orange">{{ $totalPimpinan }}</div>
                        <div class="text-label mt-2">Pimpinan</div>
                    </div>
                </div>

                <!-- Amil -->
                <div class="dashboard-col-3">
                    <div class="card-custom text-center">
                        <div class="text-value text-green">{{ $totalAmil }}</div>
                        <div class="text-label mt-2">Amil</div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>