# Sistem Manajemen & Digitalisasi LAZ PERSIS

Aplikasi web untuk manajemen operasional Lembaga Amil Zakat PERSIS.

## Fitur

- Login multi-role (Super Admin, Amil, Pimpinan)
- Dashboard statistik real-time
- Manajemen Program Zakat & Bantuan
- Pencatatan Penerimaan (Zakat, Infaq, Sedekah)
- Penyaluran Dana ke Mustahik
- Workflow Persetujuan (Draft → Ajukan → Setujui → Realisasi)
- Laporan + Export PDF
- Master Data (Muzakki, Mustahik, Amil)

## Teknologi

- Laravel 13
- MySQL
- Tailwind CSS
- DomPDF

## Akun Login

| Role | Email | Password |
|------|-------|----------|
| Super Admin | admin@lazpersis.com | password |
| Amil | amil@lazpersis.com | password |
| Pimpinan | pimpinan@lazpersis.com | password |

## Cara Install

```bash
# 1. Clone project
git clone https://github.com/ayunirizky700-cell/laz-persis.git
cd laz-persis

# 2. Install dependency
composer install
npm install

# 3. Setup .env
cp .env.example .env
php artisan key:generate

# 4. Buat database "laz_persis" di MySQL (HeidiSQL/phpMyAdmin)

# 5. Edit .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laz_persis
DB_USERNAME=root
DB_PASSWORD=

# 6. Migrate + Seed
php artisan migrate:fresh --seed

# 7. Build assets
npm run build

# 8. Jalankan
php artisan serve