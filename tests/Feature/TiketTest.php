<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TiketTest extends TestCase
{
    function testCreateTicket() : void {
        $user = User::create([
            'username' => 'pelanggan',
            'name' => 'Pelanggan',
            'email' => 'pelanggan@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'pelanggan',
            'nomor_telepon' => '081234567890',
            'alamat' => 'Jl. Jendral Sudirman'
        ]);

        $data = [
            'id_pelanggan' => $user->id,
            'tanggal_dibuat' => '2022-08-13',
            'nama_pic_fakultas' => 'Nama PIC Fakultas',
            'telepon_pic_fakultas' => '081234567890',
            'nama_pic_ruangan' => 'Nama PIC Ruangan',
            'telepon_pic_ruangan' => '081234567890',
            'keterangan' => 'Keterangan',
            'detail' => [
                [
                    'lokasi' => 'Lokasi 1',
                    'alamat' => 'Alamat 1',
                    'product' => [
                        [
                            'merk_produk' => 'Merk 1',
                            'permasalahan' => 'Permasalahan 1',
                        ],
                        [
                            'merk_produk' => 'Merk 2',
                            'permasalahan' => 'Permasalahan 2',
                        ],
                    ],
                ],
                [
                    'lokasi' => 'Lokasi 2',
                    'alamat' => 'Alamat 2',
                    'product' => [
                        [
                            'merk_produk' => 'Merk 3',
                            'permasalahan' => 'Permasalahan 3',
                        ],
                        [
                            'merk_produk' => 'Merk 4',
                            'permasalahan' => 'Permasalahan 4',
                        ],
                    ],
                ],
            ],
        ];

        $response = $this->postJson('/pelanggan/tiket/store', $data);

        Log::info('Create Ticket:'.json_encode(json_decode($response->getContent()), JSON_PRETTY_PRINT));
        $response->assertStatus(201);
    }
}
