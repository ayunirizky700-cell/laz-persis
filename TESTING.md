# Hasil Testing — Proyek LAZ PERSIS

**Tanggal:** [Tanggal Hari Ini]
**Tester:** Ayu Rizky
**Environment:** Laragon + Chrome

---

## 1. AUTHENTICATION

| No | Test Case | Expected | Actual | Status |
|----|-----------|----------|--------|:------:|
| 1 | Login admin | Masuk dashboard | Masuk | ✅ |
| 2 | Login pimpinan | Masuk dashboard | Masuk | ✅ |
| 3 | Login amil | Masuk dashboard | Masuk | ✅ |
| 4 | Login password salah | Error | Error | ✅ |
| 5 | Logout | Redirect login | Redirect | ✅ |
| 6 | Akses tanpa login | Redirect login | Redirect | ✅ |

---

## 2. MODUL PROGRAM

| No | Test Case | Expected | Actual | Status |
|----|-----------|----------|--------|:------:|
| 1 | Buka /program | List muncul | List muncul | ✅ |
| 2 | Tambah program | Kode auto | PRG-2026-0001 | ✅ |
| 3 | Edit program | Tersimpan | Tersimpan | ✅ |
| 4 | Hapus program | Data hilang | Hilang | ✅ |
| 5 | Filter tombol | Berfungsi | Berfungsi | ✅ |

---

## 3. MODUL PENERIMAAN

| No | Test Case | Expected | Actual | Status |
|----|-----------|----------|--------|:------:|
| 1 | Tambah penerimaan | No. TRX-IN | TRX-IN-2026-0001 | ✅ |
| 2 | Validasi | Status valid | Valid | ✅ |
| 3 | Auto-update dana | Program terkumpul naik | Naik | ✅ |
| 4 | Upload bukti | File tersimpan | Tersimpan | ✅ |
| 5 | Gambar tampil | Muncul | Muncul | ✅ |

---

## 4. MODUL PENYALURAN

| No | Test Case | Expected | Actual | Status |
|----|-----------|----------|--------|:------:|
| 1 | Tambah penyaluran | Status draft | Draft | ✅ |
| 2 | Ajukan | Status diajukan | Diajukan | ✅ |
| 3 | Setujui (pimpinan) | Status disetujui | Disetujui | ✅ |
| 4 | Realisasi | Status direalisasi | Direalisasi | ✅ |
| 5 | Auto-update dana | Program tersalurkan naik | Naik | ✅ |

---

## 5. MODUL MASTER DATA

| No | Test Case | Expected | Actual | Status |
|----|-----------|----------|--------|:------:|
| 1 | CRUD Muzakki | Berhasil | Berhasil | ✅ |
| 2 | Kode auto MZK | MZK-2026-XXXX | MZK-2026-0001 | ✅ |
| 3 | CRUD Mustahik | Berhasil | Berhasil | ✅ |
| 4 | Verifikasi Mustahik | Status terverifikasi | Terverifikasi | ✅ |
| 5 | CRUD Amil | Berhasil | Berhasil | ✅ |

---

## 6. MODUL LAPORAN

| No | Test Case | Expected | Actual | Status |
|----|-----------|----------|--------|:------:|
| 1 | Laporan Penerimaan | Data muncul | Muncul | ✅ |
| 2 | Laporan Penyaluran | Data muncul | Muncul | ✅ |
| 3 | Laporan Program | Data muncul | Muncul | ✅ |
| 4 | Rekap Saldo | Total benar | Benar | ✅ |
| 5 | Export PDF | File ter-download | Ter-download | ✅ |

---

## 🐛 BUG LIST

| No | Bug | Severity | Status | PIC |
|----|-----|:--------:|:------:|-----|
| 1 | - | - | - | - |

**Keterangan:** Tidak ada bug kritis.

---

## 📊 HASIL AKHIR

- **Total Test Case:** 32
- **Passed:** 32
- **Failed:** 0
- **Persentase:** **100%** ✅

**Kesimpulan:** Semua fitur berjalan sesuai requirement.