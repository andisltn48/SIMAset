<?php

namespace Tests\Unit\IterasiKedua;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LihatDaftarUnitTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLihatDaftarUnit()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('unit.get-data-unit'));
        
        $response->assertStatus(200);
    }
}
