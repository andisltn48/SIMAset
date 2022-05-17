<?php

namespace Tests\Unit\IterasiKedua;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class HapusUnitTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testHapusUnit()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->first();

        $response = $this->actingAs($user)
        ->delete(route('unit.destroy',4));
        
        $response->assertStatus(500);
    }
}
