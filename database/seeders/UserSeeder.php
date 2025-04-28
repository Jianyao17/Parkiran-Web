<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'role' => 'Admin',
                'username' => 'admin',
                'password' => 'admin123',
            ],
            [
                'role' => 'Petugas-Masuk',
                'username' => 'petugas_masuk',
                'password' => 'masuk123',
            ],
            [
                'role' => 'Petugas-Ruang',
                'username' => 'petugas_ruang',
                'password' => 'ruang123',
            ],
            [
                'role' => 'Petugas-Keluar',
                'username' => 'petugas_keluar',
                'password' => 'keluar123',
            ],
        ];
        

        foreach ($users as $user) {
            User::create([
                'username' => $user['username'],
                'password' => Hash::make($user['password']),
                'role' => $user['role'],
                'no_telp' => '0800000000', // No telp dummy
            ]);
        }
    }
}
