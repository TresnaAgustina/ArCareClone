<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
                [
                    'username' => 'admin',
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('admin'),
                    'role' => 'admin',
                    'nomor_telepon' => '08123456789',
                    'alamat' => 'Jl. Raya No. 1'
                ],
                [
                    'username' => 'manajer',
                    'name' => 'Manajer',
                    'email' => 'manajer@gmail.com',
                    'password' => bcrypt('manajer'),
                    'role' => 'manajer',
                    'nomor_telepon' => '08123456789',
                    'alamat' => 'Jl. Raya No. 1'
                ],
                [
                    'username' => 'teknisi',
                    'name' => 'Teknisi',
                    'email' => 'teknisi@gmail.com',
                    'password' => bcrypt('teknisi'),
                    'role' => 'teknisi',
                    'nomor_telepon' => '08123456789',
                    'alamat' => 'Jl. Raya No. 1'
                ],
                [
                    'username' => 'rekanan',
                    'name' => 'Rekanan',
                    'email' => 'rekanan@gmail.com',
                    'password' => bcrypt('rekanan'),
                    'role' => 'rekanan',
                    'nomor_telepon' => '08123456789',
                    'alamat' => 'Jl. Raya No. 1'
                ],
                [
                    'username' => 'pelanggan',
                    'name' => 'Pelanggan',
                    'email' => 'pelanggan@gmail.com',
                    'password' => bcrypt('pelanggan'),
                    'role' => 'pelanggan',
                    'nomor_telepon' => '08123456789',
                    'alamat' => 'Jl. Raya No. 1'
                ]
            ];

            User::insert($user);
    }
}
