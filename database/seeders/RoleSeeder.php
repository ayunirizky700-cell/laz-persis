<?php
namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['nama_role' => 'super_admin', 'deskripsi' => 'Pengelola sistem utama', 'created_at' => now(), 'updated_at' => now()],
            ['nama_role' => 'admin_amil', 'deskripsi' => 'Petugas operasional', 'created_at' => now(), 'updated_at' => now()],
            ['nama_role' => 'pimpinan', 'deskripsi' => 'Pengawas/pengambil keputusan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}