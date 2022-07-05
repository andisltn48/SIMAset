<?php

namespace Tests\Unit\IterasiKetiga;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IterasiKetigaTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLihatDaftarRuangan()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('data-ruangan.get-data-ruangan',['search'=>['value'=>'testing']]));
        
        $response->assertStatus(200);
    }

    public function testTambahDataRuangan()
    {
        $user = User::where('role_id',1)
        ->first();

        $request = [
            'kode_ruangan' => '020A',
            'nama_ruangan' => 'Ini nama ruangan',
            'pj' => "--",
            'nip' => 4433332222,
            'kode_gedung' => 209,
        ];

        $response = $this->actingAs($user)
        ->post(route('data-ruangan.store'), $request);
        
        $response->assertStatus(302);
    }
    
    public function testUpdateDataRuangan()
    {
        $user = User::where('role_id',1)
        ->first();

        $request = [
            'kode_ruangan' => '009A',
            'nama_ruangan' => 'Ini nama ruangan baru nih',
            'pj' => "--",
            'nip' => 4433332222,
            'kode_gedung' => 209,
        ];

        $response = $this->actingAs($user)
        ->put(route('data-ruangan.update',2), $request);
        
        $response->assertStatus(302);
    }

    public function testHapusDataRuanganAlreadyUse()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->delete(route('data-ruangan.destroy',2));
        
        $response->assertStatus(302);
    }

    public function testHapusDataRuangan()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->delete(route('data-ruangan.destroy',7));
        
        $response->assertStatus(302);
    }
}
