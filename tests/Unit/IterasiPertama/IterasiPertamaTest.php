<?php

namespace Tests\Unit\IterasiPertama;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class IterasiPertamaTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateDataInventaris()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->first();

        // dd($user);
        $filename = 'foto-barang.jpg';

        $file = UploadedFile::fake()->image($filename);

        $request = [
            'nama_barang' => 'kursi gaminggo',
            'jumlah_barang' => 1,
            'kode_barang' => 13342211899111,
            'nup_awal' => 10,
            'foto' => $file,
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

        $response = $this->actingAs($user)->post(route('data-inventaris.store'),$request);
        
        $response->assertStatus(302);
    }

    public function testCreateManyDataInventaris()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->first();

        // dd($user);

        Storage::fake('local');
        $file = UploadedFile::fake()->create('file.jpg');
        $request = [
            'nama_barang' => 'kursi gaminggo banyak',
            'jumlah_barang' => 3,
            'kode_barang' => 11181010,
            'nup_awal' => 4,
            'nup_akhir' => 6,
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

        $response = $this->actingAs($user)->post(route('data-inventaris.store'),$request);
        
        $response->assertStatus(302);
    }

    public function testLihatDataInventaris()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->orWhere('role_id',4)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('data-inventaris.getdatatable'));
        
        $response->assertStatus(200);
    }

    public function testLihatDataInventarisWithFilter()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->orWhere('role_id',4)
        ->first();

        $request = [
            'unit' => '001',
            'kondisi' => 'Baik',
            'koderuangan' => '009A',
            'tahunpengadaan' => '2022',
            'kodebarang' => '3050201002',
            'nup' => '382',

        ];
        $response = $this->actingAs($user)
        ->get(route('data-inventaris.getdatatable',$request));
        
        $response->assertStatus(200);
    }

    public function testLihatDataInventarisWithSearch()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->orWhere('role_id',4)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('data-inventaris.getdatatable',['search'=>['value'=>'testing']]));
        
        $response->assertStatus(200);
    }

    public function testUpdateDataInventaris()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->first();

        $request = [
            'nama_barang' => 'kursi gamilose',
            'kode_barang' => 110220222,
            'nup' => 3,
            'uraian_barang' => 'Kursi gimang untuk keperluan tidur',
            'harga_satuan' => '1000000',
            'harga_total' => '1000000',
            'nilai_tagihan' => '1000000',
            'tanggal_sp2d' => '01-01-1970 08:00:00',
            'nomor_sp2d' => 11221,
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

        $response = $this->actingAs($user)->put(route('data-inventaris.update',7),$request);
        
        $response->assertStatus(302);
    }

    public function testUpdateDataInventarisWithNewKodeAndNup()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->first();

        $request = [
            'nama_barang' => 'kursi gamilose',
            'kode_barang' => 1102202221,
            'nup' => 4,
            'uraian_barang' => 'Kursi gimang untuk keperluan tidur',
            'harga_satuan' => '1000000',
            'harga_total' => '1000000',
            'nilai_tagihan' => '1000000',
            'tanggal_sp2d' => '01-01-1970 08:00:00',
            'nomor_sp2d' => 11221,
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

        $response = $this->actingAs($user)->put(route('data-inventaris.update',7),$request);
        
        $response->assertStatus(302);
    }

    public function testDeleteDataInventaris()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->first();

        // dd($user);

        
        $response = $this->actingAs($user)->delete(route('data-inventaris.destroy',38));
        
        $response->assertStatus(302);
    }

    public function testRegister()
    {
        $value = [
            'name' => 'andilan',
            'email' => 'akunTester1@itk.ac.id',
            'password' => 'Superadmin12345',
            'password_confirmation' => 'Superadmin12345'
        ];

        $response = $this->post(route('auth.register'), $value);
        
        $response->assertStatus(302);
        $response->assertRedirect(route('register'));
    }

    public function testLoginAdmin()
    {
        $value = [
            'email' => 'SAemailSecret@itk.ac.id',
            'password' => 'Sup3r4Dm1n'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
        $response->assertRedirect('data-inventaris');
    }

    public function testLoginPeminjam() 
    {
        $value = [
            'email' => 'akunTester1@itk.ac.id',
            'password' => 'Superadmin12345'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
        $response->assertRedirect('form-peminjaman');
    }

    public function testLoginPengaju() //superadmin, admin, bmn, sarpras
    {
        $value = [
            'email' => 'unit@gmail.com',
            'password' => 'Unit12345'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
        $response->assertRedirect('form-pengajuan');
    }

    public function testLoginWrongEmailOrPassword() //superadmin, admin, bmn, sarpras
    {
        $value = [
            'email' => 'unit@gmail.coms',
            'password' => 'Unit12345'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
    }

    public function testLogout() //superadmin, admin, bmn, sarpras
    {
        $user = User::where('id','>',0)->first();
        $response = $this->actingAs($user)->get(route('auth.logout'));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
