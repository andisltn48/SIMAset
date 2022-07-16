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
    public function testCreatePeminjamanInventaris()
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

    public function testCreatePeminjamanWithManyInventaris()
    {
        $user = User::where('role_id',5)
        ->first();

        // dd($user);

        $items = [1,5,6];
        \Session::put('tempo-data', $items);
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

    public function testGetPeminjamanInventarisAdmin()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.getdatapeminjaman',['search' => ['value'=>'test']]));
        
        $response->assertStatus(200);
    }

    public function testGetPeminjamanInventarisUser()
    {
        $user = User::where('email','unit@gmail.com')
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.getdatapeminjaman',['search' => ['value'=>'test'],'id' => $user->id]));
        
        $response->assertStatus(200);
    }

    public function testGetPermintaanPeminjamanInventarisAdmin()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.getdatapermintaanpeminjaman-admin',['search' => ['value'=>'test']]));
        
        $response->assertStatus(200);
    }

    public function testGetPermintaanPeminjamanInventarisUser()
    {
        $user = User::where('email','unit@gmail.com')
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.getdatapermintaanpeminjaman',['search' => ['value'=>'test'],'id' => $user->id]));
        
        $response->assertStatus(200);
    }

    public function testTerimaPermintaanPeminjamanInventaris()
    {
        $user = User::where('role_id',1)
        ->first();

        // dd($user);
        $request = [
            'status' => 'Disetujui' //Disetujui atau Ditolak
        ];


        $response = $this->actingAs($user)->post(route('peminjaman.confirm-request', 7), $request);
        
        $response->assertStatus(302);
    }

    public function testTolakPermintaanPeminjamanInventaris()
    {
        $user = User::where('role_id',1)
        ->first();

        // dd($user);
        $request = [
            'status' => 'Ditolak' //Disetujui atau Ditolak
        ];


        $response = $this->actingAs($user)->post(route('peminjaman.confirm-request', 8), $request);
        
        $response->assertStatus(302);
    }

    public function testUpdateStatusPeminjamanInventaris()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)->get(route('peminjaman.done-peminjaman',2));
        
        $response->assertStatus(302);
    }

    public function testDeletePengajuanDataInventaris()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)->post(route('peminjaman.destroy-peminjaman', 3));
        
        $response->assertStatus(302);
    }
}
