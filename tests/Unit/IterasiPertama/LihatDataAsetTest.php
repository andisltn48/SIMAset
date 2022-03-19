<?php

namespace Tests\Unit\IterasiPertama;

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
    public function testLihatDataAset()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->orWhere('role_id',4)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('data-aset.index'));
        
        $response->assertStatus(200);
    }
}
