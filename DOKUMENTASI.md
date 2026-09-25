# Dokumentasi Proyek LAZ PERSIS

## 1. Identitas Proyek
- **Nama**: Sistem Manajemen & Digitalisasi LAZ PERSIS
- **Client**: LAZ PERSIS
- **Jenis**: Aplikasi Web Manajemen Lembaga Amil Zakat

## 2. Latar Belakang
LAZ PERSIS membutuhkan aplikasi berbasis web untuk digitalisasi operasional.

## 3. Tujuan Sistem
- Mendigitalisasi proses administrasi
- Memusatkan data dalam satu sistem
- Membantu pencatatan penerimaan & penyaluran
- Menyediakan dashboard monitoring
- Mempermudah pembuatan laporan

## 4. Aktor / Role Pengguna
| Aktor | Hak Akses |
|-------|-----------|
| Super Admin | Kelola semua modul |
| Admin/Amil | Kelola muzakki, mustahik, program, transaksi |
| Pimpinan | Dashboard, monitoring, persetujuan |

## 5. Fitur Utama
### A. Authentication
- Login multi-role
- Manajemen user & role

### B. Dashboard
- Ringkasan statistik
- Grafik penerimaan & penyaluran

### C. Master Data
- Muzakki (pemberi zakat)
- Mustahik (penerima + verifikasi)
- Amil (petugas LAZ)

### D. Program
- CRUD program penghimpunan/penyaluran
- Monitoring capaian

### E. Penerimaan Dana
- Catat penerimaan (zakat, infaq, sedekah)
- Validasi transaksi
- Upload bukti

### F. Penyaluran Dana
- Workflow: Draft → Ajukan → Setujui → Realisasi
- Upload dokumentasi

### G. Persetujuan
- Approve/reject oleh Pimpinan

### H. Laporan
- Laporan penerimaan, penyaluran, program
- Export PDF

## 6. Use Case Utama
1. Login sebagai role
2. Kelola master data
3. Catat penerimaan dana
4. Catat penyaluran dana
5. Persetujuan pimpinan
6. Generate laporan

## 7. Alur Sistem
[Masukkan diagram alur]

## 8. Struktur Database
### Tabel Utama:
- users, roles
- muzakki, mustahik, amil
- program, penerimaan, penyaluran
- persetujuan, activity_logs

## 9. Implementasi
- **Framework**: Laravel 13
- **Database**: MySQL
- **Frontend**: Blade + Tailwind CSS
- **PDF**: DomPDF

## 10. Testing
| Fitur | Status |
|-------|:------:|
| Login multi-role | ✅ |
| CRUD Program | ✅ |
| Penerimaan + Validasi | ✅ |
| Penyaluran Workflow | ✅ |
| Persetujuan | ✅ |
| Laporan + PDF | ✅ |
| Master Data | ✅ |

## 11. Kesimpulan
Aplikasi berhasil dibuat & berjalan sesuai kebutuhan LAZ PERSIS.

## 12. Saran
- Integrasi payment gateway
- Notifikasi WhatsApp
- Mobile app