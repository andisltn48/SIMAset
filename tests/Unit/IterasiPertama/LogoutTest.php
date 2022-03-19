<?php

namespace Tests\Unit\IterasiPertama;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LogoutTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLogout() //superadmin, admin, bmn, sarpras
    {
        $user = User::where('id','>',0)->first();
        $response = $this->actingAs($user)->get(route('auth.logout'));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
