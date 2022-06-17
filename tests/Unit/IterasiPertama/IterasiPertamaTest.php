<?php

namespace Tests\Unit\IterasiPertama;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IterasiPertamaTest extends TestCase
{
    use WithoutMiddleware;
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
            'kode_barang' => 13342211899111,
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

    public function testLihatDataAset()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->orWhere('role_id',4)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('data-aset.getdatatable'));
        
        $response->assertStatus(200);
    }

    public function testUpdateDataAset()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->first();

        $request = [
            'nama_barang' => 'kursi gamilose',
            'kode_barang' => 110220033221,
            'nup' => 1233,
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

        $response = $this->actingAs($user)->put(route('data-aset.update',7),$request);
        
        $response->assertStatus(302);
    }

    public function testDeleteDataAset()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->first();

        // dd($user);

        
        $response = $this->actingAs($user)->delete(route('data-aset.destroy',21));
        
        $response->assertStatus(302);
    }

    public function testRegister()
    {
        $value = [
            'name' => 'andilan',
            'email' => 'newAkunTesterss46@itk.ac.id',
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
            'email' => 'superadmin@itk.ac.id',
            'password' => 'Superadmin12345'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
        $response->assertRedirect('data-aset');
    }

    public function testLoginPeminjam() //superadmin, admin, bmn, sarpras
    {
        $value = [
            'email' => 'andiaril186@gmail.com',
            'password' => 'Andilan12345'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
        $response->assertRedirect('form-peminjaman');
    }

    public function testLoginPengaju() //superadmin, admin, bmn, sarpras
    {
        $value = [
            'email' => 'pengaju@gmail.com',
            'password' => 'Pengaju12345'
        ];

        $response = $this->post(route('auth.login'), $value);

        $response->assertStatus(302);
        $response->assertRedirect('form-pengajuan');
    }

    public function testLogout() //superadmin, admin, bmn, sarpras
    {
        $user = User::where('id','>',0)->first();
        $response = $this->actingAs($user)->get(route('auth.logout'));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
