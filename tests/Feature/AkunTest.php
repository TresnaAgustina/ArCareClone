<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class AkunTest extends TestCase
{
    function testCreateAkun() : void {
        $response = $this->post('/admin/akun/store', [
            'username' => 'kolasotelaso',
            'name' => 'Kolaso Telaso',
            'email' => 'admin@dddf.com',
            'password' => 'adminadmin',
            'role' => 'admin',
            'nomor_telepon' => '081234567897',
            'alamat' => 'Jl. Jalan No. 1',
        ]);

        Log::info('Create:'.json_encode(json_decode($response->getContent()), JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }

    function testUpdateAkun() : void {
        $response = $this->post('/admin/akun/update/3', [
            'username' => 'kolasotelaso',
            'name' => 'Kolaso Telaso',
            'email' => 'telaso@shak.com',
            'password' => 'adminadmin',
            'role' => 'admin',
            'nomor_telepon' => '081234567877',
            'alamat' => 'Jl. Jalan No. 1',
        ]);

        Log::info('Update:'.json_encode(json_decode($response->getContent()), JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }

    function testDeleteAkun() : void {
        $response = $this->delete('/admin/akun/delete/3');
        Log::info('Delete:'.json_encode(json_decode($response->getContent()), JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }
}
