<?php

namespace Tests\Unit\IterasiKedua;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateUnitTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUpdateUnit()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->first();

        $request = [
            'kode' => '005',
            'nama' => 'BUMNS Abis Update'
        ];

        $response = $this->actingAs($user)
        ->put(route('unit.update',17), $request);
        
        $response->assertStatus(302);
    }
}
