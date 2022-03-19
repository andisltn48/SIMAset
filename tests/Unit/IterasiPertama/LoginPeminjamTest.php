<?php

namespace Tests\Unit\IterasiPertama;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LoginPeminjamTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLoginPeminjam() //superadmin, admin, bmn, sarpras
    {
        $value = [
            'email' => 'andiaril186@gmail.com',
            'password' => 'Andilan12345'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
        $response->assertRedirect('form-peminjaman');
    }
}
