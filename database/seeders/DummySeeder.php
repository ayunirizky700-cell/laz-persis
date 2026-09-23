<?php
namespace Database\Seeders;
use App\Models\Muzakki;
use App\Models\Mustahik;
use App\Models\Program;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    public function run(): void
    {
        // Muzakki contoh
        Muzakki::create(['nama' => 'Ahmad Fauzi', 'no_telepon' => '081234567890', 'alamat' => 'Jl. Merdeka No. 1', 'kategori' => 'individu']);
        Muzakki::create(['nama' => 'PT Berkah Jaya', 'no_telepon' => '0211234567', 'alamat' => 'Jl. Sudirman No. 10', 'kategori' => 'perusahaan']);

        // Mustahik contoh
        Mustahik::create(['nama' => 'Budi Santoso', 'alamat' => 'Jl. Melati No. 5', 'no_telepon' => '082111111111', 'kategori_asnaf' => 'fakir', 'status_verifikasi' => 'terverifikasi']);
        Mustahik::create(['nama' => 'Siti Aminah', 'alamat' => 'Jl. Anggrek No. 3', 'no_telepon' => '082222222222', 'kategori_asnaf' => 'miskin', 'status_verifikasi' => 'terverifikasi']);

        // Program contoh
        Program::create([
            'nama_program' => 'Beasiswa Anak Yatim',
            'deskripsi' => 'Program beasiswa untuk anak yatim',
            'kategori' => 'pendidikan',
            'jenis' => 'penyaluran',
            'target_dana' => 50000000,
            'periode_mulai' => now(),
            'status' => 'aktif'
        ]);

        Program::create([
            'nama_program' => 'Zakat Produktif',
            'deskripsi' => 'Pemberdayaan ekonomi mustahik',
            'kategori' => 'ekonomi',
            'jenis' => 'penghimpunan',
            'target_dana' => 100000000,
            'periode_mulai' => now(),
            'status' => 'aktif'
        ]);
    }
}