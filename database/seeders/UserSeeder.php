<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        $sa = Role::where('nama_role','super_admin')->first()->id;
        $aa = Role::where('nama_role','admin_amil')->first()->id;
        $pp = Role::where('nama_role','pimpinan')->first()->id;

        User::create([
            'name' => 'Super Admin',
            'nama' => 'Super Admin',
            'email' => 'superadmin@laz.com',
            'password' => Hash::make('password'),
            'role_id' => $sa,
            'status' => 'aktif'
        ]);

        User::create([
            'name' => 'Admin Amil',
            'nama' => 'Admin Amil',
            'email' => 'admin@laz.com',
            'password' => Hash::make('password'),
            'role_id' => $aa,
            'status' => 'aktif'
        ]);

        User::create([
            'name' => 'Pimpinan LAZ',
            'nama' => 'Pimpinan LAZ',
            'email' => 'pimpinan@laz.com',
            'password' => Hash::make('password'),
            'role_id' => $pp,
            'status' => 'aktif'
        ]);
    }
}