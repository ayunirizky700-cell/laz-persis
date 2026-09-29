# UI/UX Design — Sistem Manajemen LAZ PERSIS

## 1. Design System

### A. Warna Utama
| Warna | Kode | Penggunaan |
|-------|------|------------|
| Primary | #2563EB (Biru) | Tombol utama, header |
| Success | #16A34A (Hijau) | Status valid, sukses |
| Warning | #EAB308 (Kuning) | Status pending |
| Danger | #DC2626 (Merah) | Hapus, tolak |
| Gray | #6B7280 | Text sekunder |

### B. Typography
- **Font:** Inter / System Sans-serif
- **Heading:** Bold (700)
- **Body:** Regular (400)
- **Ukuran:** 14px (body), 18px (subjudul), 24px (judul)

### C. Komponen Standar
- **Tombol:** Rounded-lg, padding 12px 24px
- **Card:** Shadow-md, rounded-xl
- **Form Input:** Border gray-300, focus ring blue
- **Tabel:** Header gray-100, border-t

## 2. Layout

### A. Struktur Halaman┌─────────────────────────────────────┐
│ NAVBAR (Logo | Menu | User) │
├─────────────────────────────────────┤
│ HEADER (Judul Halaman) │
├─────────────────────────────────────┤
│ │
│ KONTEN UTAMA │
│ - Filter / Search │
│ - Tabel / Card │
│ - Aksi (Tambah, Edit, Hapus) │
│ │
├─────────────────────────────────────┤
│ FOOTER │
└─────────────────────────────────────┘

### B. Responsive
- **Desktop:** > 1024px
- **Tablet:** 768px - 1024px
- **Mobile:** < 768px

## 3. Halaman Utama

### A. Login
- Form centered
- Logo aplikasi
- Input email & password
- Tombol Login biru

### B. Dashboard
- 4 kartu statistik (Pengguna, Muzakki, Mustahik, Amil)
- 3 kartu keuangan (Penerimaan, Penyaluran, Saldo)
- Banner selamat datang gradient

### C. Master Data (Muzakki, Mustahik, Amil)
- Tabel dengan pagination
- Search bar
- Filter status
- Tombol "+ Tambah"

### D. Transaksi (Penerimaan, Penyaluran)
- Tabel dengan status badge
- Filter tanggal & status
- Tombol aksi per baris (Validasi, Ajukan, Realisasi)

### E. Laporan
- Menu 4 kotak (Penerimaan, Penyaluran, Program, Rekap)
- Filter periode
- Tombol Export PDF

## 4. Status Badge

| Status | Warna | Kode |
|--------|-------|------|
| Pending | Kuning | bg-yellow-100 text-yellow-700 |
| Valid/Disetujui | Hijau | bg-green-100 text-green-700 |
| Ditolak | Merah | bg-red-100 text-red-700 |
| Draft | Abu-abu | bg-gray-100 text-gray-700 |

## 5. Alur User Experience

### A. Login → Dashboard
1. User buka aplikasi
2. Login dengan email & password
3. Redirect ke dashboard sesuai role

### B. Tambah Data (Contoh: Program)
1. Klik menu Program
2. Klik tombol "+ Tambah Program"
3. Isi form
4. Klik Simpan
5. Notifikasi sukses

### C. Workflow Penyaluran
1. Admin buat draft
2. Admin ajukan
3. Pimpinan review
4. Pimpinan approve
5. Admin realisasi
6. Update rekap otomatis