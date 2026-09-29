# Dokumentasi Testing — Sistem Manajemen LAZ PERSIS

**Tanggal Testing:** [Tanggal]
**Tester:** Ayu Rizky
**Environment:** Laragon, Chrome, Windows

## 1. Test Case

### A. Authentication
| No | Test Case | Expected | Result | Status |
|----|-----------|----------|--------|--------|
| 1.1 | Login admin | Masuk dashboard | Masuk | ✅ PASS |
| 1.2 | Login pimpinan | Masuk dashboard | Masuk | ✅ PASS |
| 1.3 | Login amil | Masuk dashboard | Masuk | ✅ PASS |
| 1.4 | Login password salah | Error | Error | ✅ PASS |
| 1.5 | Logout | Redirect login | Redirect | ✅ PASS |
| 1.6 | Akses tanpa login | Redirect login | Redirect | ✅ PASS |

### B. Modul Program
| No | Test Case | Expected | Result | Status |
|----|-----------|----------|--------|--------|
| 2.1 | Buka /program | List muncul | List muncul | ✅ PASS |
| 2.2 | Tambah program | Kode auto PRG-YYYY-XXXX | PRG-2026-0001 | ✅ PASS |
| 2.3 | Edit program | Tersimpan | Tersimpan | ✅ PASS |
| 2.4 | Hapus program | Data hilang | Hilang | ✅ PASS |
| 2.5 | Filter tombol status | Berfungsi | Berfungsi | ✅ PASS |

### C. Modul Penerimaan
| No | Test Case | Expected | Result | Status |
|----|-----------|----------|--------|--------|
| 3.1 | Tambah penerimaan | No. auto TRX-IN | TRX-IN-2026-0001 | ✅ PASS |
| 3.2 | Validasi penerimaan | Status valid | Valid | ✅ PASS |
| 3.3 | Auto-update dana | Program terkumpul naik | Naik | ✅ PASS |
| 3.4 | Upload bukti | File tersimpan | Tersimpan | ✅ PASS |
| 3.5 | Gambar tampil | Muncul | Muncul | ✅ PASS |

### D. Modul Penyaluran
| No | Test Case | Expected | Result | Status |
|----|-----------|----------|--------|--------|
| 4.1 | Tambah penyaluran | Status draft | Draft | ✅ PASS |
| 4.2 | Ajukan ke pimpinan | Status diajukan | Diajukan | ✅ PASS |
| 4.3 | Pimpinan setujui | Status disetujui | Disetujui | ✅ PASS |
| 4.4 | Admin realisasi | Status direalisasi | Direalisasi | ✅ PASS |
| 4.5 | Auto-update dana | Program tersalurkan naik | Naik | ✅ PASS |

### E. Modul Persetujuan
| No | Test Case | Expected | Result | Status |
|----|-----------|----------|--------|--------|
| 5.1 | Lihat pengajuan | Pengajuan muncul | Muncul | ✅ PASS |
| 5.2 | Approve | Status disetujui | Disetujui | ✅ PASS |
| 5.3 | Reject + catatan | Status ditolak | Ditolak | ✅ PASS |

### F. Modul Laporan
| No | Test Case | Expected | Result | Status |
|----|-----------|----------|--------|--------|
| 6.1 | Laporan Penerimaan | Data muncul | Muncul | ✅ PASS |
| 6.2 | Laporan Penyaluran | Data muncul | Muncul | ✅ PASS |
| 6.3 | Laporan Program | Progress bar | Muncul | ✅ PASS |
| 6.4 | Rekap Saldo | Perhitungan benar | Benar | ✅ PASS |
| 6.5 | Export PDF | File ter-download | Berhasil | ✅ PASS |

### G. Modul Master Data
| No | Test Case | Expected | Result | Status |
|----|-----------|----------|--------|--------|
| 7.1 | CRUD Muzakki | Berhasil | Berhasil | ✅ PASS |
| 7.2 | Kode auto MZK | MZK-2026-XXXX | Berhasil | ✅ PASS |
| 7.3 | CRUD Mustahik | Berhasil | Berhasil | ✅ PASS |
| 7.4 | Verifikasi mustahik | Status terverifikasi | Berhasil | ✅ PASS |
| 7.5 | CRUD Amil | Berhasil | Berhasil | ✅ PASS |

### H. Dashboard
| No | Test Case | Expected | Result | Status |
|----|-----------|----------|--------|--------|
| 8.1 | Kartu statistik | Angka muncul | Muncul | ✅ PASS |
| 8.2 | Data real-time | Update otomatis | Update | ✅ PASS |

## 2. Hasil Testing

| Kategori | Total Test | Passed | Failed |
|----------|:----------:|:------:|:------:|
| Authentication | 6 | 6 | 0 |
| Program | 5 | 5 | 0 |
| Penerimaan | 5 | 5 | 0 |
| Penyaluran | 5 | 5 | 0 |
| Persetujuan | 3 | 3 | 0 |
| Laporan | 5 | 5 | 0 |
| Master Data | 5 | 5 | 0 |
| Dashboard | 2 | 2 | 0 |
| **TOTAL** | **36** | **36** | **0** |

**Persentase: 100% PASS** ✅

## 3. Kesimpulan

Semua test case **berhasil** dijalankan. Aplikasi berjalan sesuai requirement.