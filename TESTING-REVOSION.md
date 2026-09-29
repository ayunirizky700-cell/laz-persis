# Catatan Revisi & Bug Fixing

## 1. Daftar Bug yang Ditemukan

| No | Bug | Severity | Tanggal | Fix | Status |
|----|-----|:--------:|:-------:|-----|:------:|
| 1 | Error `$totalUsers` di dashboard | High | 24 Sept | Tambah variabel di controller | ✅ FIXED |
| 2 | Error `$totalAmil` undefined | High | 24 Sept | Import Model Amil | ✅ FIXED |
| 3 | Gambar bukti tidak muncul | Medium | 24 Sept | Jalankan storage:link | ✅ FIXED |
| 4 | Tabel amil tidak ditemukan | High | 25 Sept | Jalankan migrate | ✅ FIXED |
| 5 | Dropdown filter tertimpa | Low | 25 Sept | Ganti jadi tombol | ✅ FIXED |
| 6 | Navbar duplikat menu Amil | Low | 25 Sept | Hapus duplikat | ✅ FIXED |
| 7 | Conflict merge Git | Medium | 25 Sept | Resolve manual | ✅ FIXED |
| 8 | Route users.index not defined | High | 25 Sept | Comment menu | ✅ FIXED |

## 2. Ringkasan Revisi

| Kategori | Jumlah |
|----------|:------:|
| Bug Kritis (High) | 4 |
| Bug Menengah (Medium) | 2 |
| Bug Ringan (Low) | 2 |
| **Total** | **8** |

**Semua bug sudah di-fix** ✅

## 3. Pelajaran yang Didapat

1. Selalu cek model & migration sebelum pakai
2. Storage link wajib untuk upload file
3. Hati-hati saat merge conflict — cek duplikat
4. Import class di controller wajib
5. Test di multiple browser