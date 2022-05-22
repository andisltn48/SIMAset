<?php

namespace Tests\Unit\IterasiKedua;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LihatAktivitasSistemTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLihatAktivitasSistem()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('aktivitas-sistem.get-aktivitas'));
        
        $response->assertStatus(200);
    }
}
