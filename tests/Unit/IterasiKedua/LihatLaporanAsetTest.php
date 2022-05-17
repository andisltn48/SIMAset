<?php

namespace Tests\Unit\IterasiKedua;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LihatDataAsetTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLihatLaporanAset()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('laporan-aset.index'));
        
        $response->assertStatus(200);
    }
}
