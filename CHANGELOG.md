# Changelog — Sistem Manajemen LAZ PERSIS

Semua perubahan penting pada proyek ini akan dicatat di file ini.

## [1.0.0] - 25 September 2026 — RELEASE PERTAMA

### Added (Ditambahkan)
- Setup Laravel 13 + Breeze
- Database 10 tabel aplikasi
- Model + Seeder
- Autentikasi multi-role (super_admin, admin_amil, pimpinan)
- Dashboard statistik
- CRUD Program (kode auto PRG-YYYY-XXXX)
- CRUD Muzakki (kode auto MZK-YYYY-XXXX)
- CRUD Mustahik + verifikasi
- CRUD Amil
- Pencatatan Penerimaan (TRX-IN-YYYY-XXXX)
- Pencatatan Penyaluran (workflow draft-ajukan-setujui-realisasi)
- Menu Persetujuan (approve/reject)
- Laporan Penerimaan, Penyaluran, Program, Rekap Saldo
- Export PDF laporan
- Profil User
- Navbar role-based (beda per role)
- Storage link untuk upload bukti

### Fixed (Diperbaiki)
- Error `$totalUsers` undefined di dashboard
- Error `$totalAmil` undefined
- Error gambar tidak muncul (storage link)
- Error tabel amil tidak ditemukan
- Dropdown filter tertimpa teks
- Navbar duplikat menu Amil
- Conflict merge Git
- Route users.index not defined

### Changed (Diubah)
- Redesign tampilan dashboard
- Redesign tampilan profil
- Ganti dropdown filter jadi tombol

### Known Issues (Masalah Diketahui)
- Export Excel belum (opsional)
- Menu Users & Roles belum aktif
- Activity Log belum dibuat
- Portal Muzakki/Mustahik belum (opsional)

## [Rencana Selanjutnya]
- [ ] Aktifkan menu Users & Roles
- [ ] Buat Activity Log
- [ ] Export Excel
- [ ] Portal Muzakki/Mustahik (opsional)
- [ ] Demo ke client