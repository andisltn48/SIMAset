<?php

namespace Tests\Unit\IterasiPertama;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LoginAdminTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLoginAdmin() //superadmin, admin, bmn, sarpras
    {
        $value = [
            'email' => 'superadmin@itk.ac.id',
            'password' => 'Superadmin12345'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
        $response->assertRedirect('data-aset');
    }
}
