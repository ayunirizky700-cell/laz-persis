<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID role dari tabel roles
        $roleSuperAdmin = Role::where('nama_role', 'super_admin')->first();
        $rolePimpinan = Role::where('nama_role', 'pimpinan')->first();
        $roleAmil = Role::where('nama_role', 'admin_amil')->first();

        // Akun Super Admin
        User::create([
            'name' => 'Super Admin',
            'nama' => 'Super Admin LAZ',
            'email' => 'admin@lazpersis.com',
            'password' => Hash::make('password123'),
            'role_id' => $roleSuperAdmin ? $roleSuperAdmin->id : null,
            'status' => 'aktif',
        ]);

        // Akun Amil
        User::create([
            'name' => 'Amil Satu',
            'nama' => 'Amil Satu',
            'email' => 'amil@lazpersis.com',
            'password' => Hash::make('password123'),
            'role_id' => $roleAmil ? $roleAmil->id : null,
            'status' => 'aktif',
        ]);

        // Akun Pimpinan
        User::create([
            'name' => 'Pimpinan LAZ',
            'nama' => 'Pimpinan LAZ',
            'email' => 'pimpinan@lazpersis.com',
            'password' => Hash::make('password123'),
            'role_id' => $rolePimpinan ? $rolePimpinan->id : null,
            'status' => 'aktif',
        ]);
    }
}