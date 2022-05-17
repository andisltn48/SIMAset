<?php

namespace Tests\Unit\IterasiKedua;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TambahUnitTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testTambahUnit()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->first();

        $request = [
            'kode' => '005',
            'nama' => 'BUMNS'
        ];

        $response = $this->actingAs($user)
        ->post(route('unit.store'), $request);
        
        $response->assertStatus(500);
    }
}
