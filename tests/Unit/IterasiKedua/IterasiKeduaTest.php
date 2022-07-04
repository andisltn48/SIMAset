<?php

namespace Tests\Unit\IterasiKedua;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IterasiKeduaTest extends TestCase
{
    use WithoutMiddleware;
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

    public function testLihatDaftarUnit()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('unit.get-data-unit'));
        
        $response->assertStatus(200);
    }

    public function testHapusUnit()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->delete(route('unit.destroy',4));
        
        $response->assertStatus(302);
    }

    public function testLihatLaporanInventaris()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('laporan-inventaris.index'));
        
        $response->assertStatus(200);
    }

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
        
        $response->assertStatus(302);
    }

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
        ->put(route('unit.update',2), $request);
        
        $response->assertStatus(302);
    }
}
