<?php

namespace Tests\Unit\IterasiPertama;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CreateDataAsetTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateDataAset()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->first();

        // dd($user);

        $request = [
            'nama_barang' => 'kursi gaminggo',
            'jumlah_barang' => 1,
            'kode_barang' => 1334132211899111,
            'nup_awal' => 2221,
            'uraian_barang' => 'Kursi gimang untuk keperluan tidur',
            'harga_satuan' => 1000000,
            'harga_total' => 1000000,
            'nilai_tagihan' => 1000000,
            'tanggal_sp2d' => '01-01-1970 08:00:00',
            'nomor_sp2d' => 11221,
            'kelompok_belanja' => 'wdadwad',
            'asal_perolehan' => 'wdadwad',
            'nomor_bukti_perolehan' => '112233',
            'merk' => 'logatik',
            'sumber_dana' => 'wdadwad',
            'pic' => 'wdadwad',
            'kode_ruangan' => 'wdadwad',
            'kondisi' => 'wdadwad',
            'unit' => '001',
            'status' => 'Aktif',
            'tahun_pengadaan' => '2033',
        ];

        $response = $this->actingAs($user)->post(route('data-aset.store'),$request);
        
        $response->assertStatus(302);
    }
}
