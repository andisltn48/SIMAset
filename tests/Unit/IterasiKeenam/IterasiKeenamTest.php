<?php

namespace Tests\Unit\IterasiKeenam;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;

class IterasiKeenamTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatePeminjamanAset()
    {
        $user = User::where('role_id',5)
        ->first();

        // dd($user);

        $request = [
            'nama_peminjam' => 'Andi test pinjam',
            'penanggung_jawab' => 'Dosen Andi',
            'id_peminjam' => $user->id,
            'sarana' => 7,
            'jumlah' => 1,
            'tanggal_awal_penggunaan' => date("Y-m-d H:i"),
            'tanggal_akhir_penggunaan' => date('d-m-Y H:i'),
            'surat_peminjaman' => UploadedFile::fake()->create('surat_peminjaman_test.pdf', 720),
            'datadiri_penanggungjawab' => UploadedFile::fake()->create('surat_peminjaman_test.pdf', 720),
            'saran' => 'ini adalah testing'
        ];

        $response = $this->actingAs($user)->post(route('peminjaman.store-permintaan'),$request);
        
        $response->assertStatus(302);
    }

    public function testGetPeminjamanAsetAdmin()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.getdatapeminjaman'));
        
        $response->assertStatus(200);
    }

    public function testGetPeminjamanAsetUser()
    {
        $user = User::where('role_id',5)
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.getdatapeminjaman'),['id' => $user->id]);
        
        $response->assertStatus(200);
    }

    public function testGetPermintaanPeminjamanAsetAdmin()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.getdatapermintaanpeminjaman-admin'));
        
        $response->assertStatus(200);
    }

    public function testGetPermintaanPeminjamanAsetUser()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.getdatapermintaanpeminjaman'),['id'=>$user->id]);
        
        $response->assertStatus(200);
    }

    public function testConfirmPermintaanPeminjamanAset()
    {
        $user = User::where('role_id',1)
        ->first();

        // dd($user);
        $request = [
            'status' => 'Disetujui' //Disetujui atau Ditolak
        ];


        $response = $this->actingAs($user)->post(route('peminjaman.confirm-request', 29), $request);
        
        $response->assertStatus(302);
    }

    public function testUpdateStatusPeminjamanAset()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.done-peminjaman',37));
        
        $response->assertStatus(302);
    }

    public function testDeletePengajuanDataAset()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)->post(route('peminjaman.destroy-peminjaman', 36));
        
        $response->assertStatus(302);
    }
}
