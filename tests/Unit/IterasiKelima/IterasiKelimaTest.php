<?php

namespace Tests\Unit\IterasiKelima;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IterasiKelimaTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatePengajuanDataInventaris()
    {
        $user = User::where('role_id',5)
        ->first();

        // dd($user);

        $request = [
            'nama_barang' => 'kursi gaminggo',
            'jumlah_barang' => 1,
            'kode_barang' => 43252,
            'nup_awal' => 9,
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

        $response = $this->actingAs($user)->post(route('pengajuan.store-pengajuan'),$request);
        
        $response->assertStatus(302);
    }

    public function testGetPengajuanDataInventaris()
    {
        $user = User::where('role_id',5)
        ->first();

        $response = $this->actingAs($user)->get(route('pengajuan.getdatapengajuan'));
        
        $response->assertStatus(200);
    }

    public function testTerimaPengajuanDataInventaris()
    {
        $user = User::where('role_id',1)
        ->first();

        // dd($user);
        $request = [
            'status' => 'Disetujui' //Disetujui atau Ditolak
        ];


        $response = $this->actingAs($user)->post(route('pengajuan.confirm-request',12), $request);
        
        $response->assertStatus(302);
    }

    public function testTolakPengajuanDataInventaris()
    {
        $user = User::where('role_id',1)
        ->first();

        // dd($user);
        $request = [
            'status' => 'Ditolak' //Disetujui atau Ditolak
        ];


        $response = $this->actingAs($user)->post(route('pengajuan.confirm-request',13), $request);
        
        $response->assertStatus(302);
    }

    public function testDeletePengajuanDataInventaris()
    {
        $user = User::where('role_id',5)
        ->first();


        $response = $this->actingAs($user)->delete(route('pengajuan.destroy-pengajuan', 8));
        
        $response->assertStatus(302);
    }
}
