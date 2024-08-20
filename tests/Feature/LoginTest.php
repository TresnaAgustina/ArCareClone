<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin() : void {
        $user = User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'nomor_telepon' => '08123456789',
            'alamat' => 'Jl. Raya No. 1'
        ]);


        $response = $this->post('/auth/login', [
            'username' => $user->username,
            'password' => 'admin',
        ]);

        Log::info(json_encode(json_decode($response->getContent()), JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }

    // function testLogout() : void {
    //     $user = User::create([
    //         'username' => 'admin',
    //         'email' => 'admin@gmail.com',
    //         'password' => bcrypt('admin'),
    //         'role' => 'admin',
    //         'nomor_telepon' => '08123456789',
    //         'alamat' => 'Jl. Raya No. 1'
    //     ]);

    //     $response = $this->post('/login', [
    //         'username' => $user->username,
    //         'password' => 'admin',
    //     ]);

    //     $response->assertStatus(200);

    //     $response = $this->post('/logout');

    //     $response->assertStatus(200);
    // }
}
