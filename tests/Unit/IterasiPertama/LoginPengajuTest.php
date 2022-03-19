<?php

namespace Tests\Unit\IterasiPertama;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LoginPengajuTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLoginPengaju() //superadmin, admin, bmn, sarpras
    {
        $value = [
            'email' => 'pengaju@gmail.com',
            'password' => 'Pengaju12345'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
        $response->assertRedirect('form-pengajuan');
    }
}
