<?php

namespace Tests\Unit\IterasiPertama;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateDataAsetTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUpdateDataAset()
    {
        $request = [
            'nama_barang' => 'kursi gaminggo',
            'kode_barang' => '110220033221',
            'nup' => '1233',
            'uraian_barang' => 'Kursi gimang untuk keperluan tidur',
            'harga_satuan' => '1000000',
            'harga_total' => '1000000',
            'nilai_tagihan' => '1000000',
            'tanggal_sp2d' => '01-01-1970 08:00:00',
            'nomor_sp2d' => '11221',
            'kelompok_belanja' => '-',
            'asal_perolehan' => '-',
            'nomor_bukti_perolehan' => '-',
            'merk' => '-',
            'sumber_dana' => '-',
            'pic' => '-',
            'kode_ruangan' => '-',
            'kondisi' => '-',
            'unit' => '-',
            'status' => 'Aktif',
            'tahun_pengadaan' => '-',
        ];

        $response = $this->put(route('data-aset.update',2),$request);
        
        $response->assertStatus(302);
    }
}
