<?php

namespace Tests\Unit\IterasiKeempat;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IterasiKeempatTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLihatDaftarSuperAdmin()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('manajemen-user.get-superadmin',['search'=>['value'=>'testing']]));
        
        $response->assertStatus(200);
    }

    public function testLihatDaftarAdmin()
    {
        $user = User::where('role_id',1)
        ->first();

        $request = [
            'search' => [
                'value' => 'test'
            ]
        ];
        $response = $this->actingAs($user)
        ->get(route('manajemen-user.get-admin',$request));
        
        $response->assertStatus(200);
    }

    public function testLihatDaftarSarpras()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('manajemen-user.get-sarpras',['search'=>['value'=>'search data']]));
        
        $response->assertStatus(200);
    }

    public function testLihatDaftarPeminjam()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('manajemen-user.get-peminjam',['search'=>['value'=>'testing']]));
        
        $response->assertStatus(200);
    }

    public function testLihatDaftarPengaju()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->get(route('manajemen-user.get-pengaju',['search'=>['value'=>'testing']]));
        
        $response->assertStatus(200);
    }

    public function testHapusUser()
    {
        $user = User::where('role_id',1)
        ->first();

        $response = $this->actingAs($user)
        ->delete(route('manajemen-user.destroy',29));
        
        $response->assertStatus(302);
    }

    public function testTambahUser()
    {
        $user = User::where('role_id',1)
        ->first();

        $request = [
            'name' => 'userTesting3',
            'email' => 'userTesting3@gmail.com',
            'password' => 'userTesting12345',
            'password_confirmation' => 'userTesting12345',
            'role' => 1,
        ];

        $response = $this->actingAs($user)
        ->post(route('manajemen-user.store'),$request);
        
        $response->assertStatus(302);
    }

    public function testUpdateUser()
    {
        $user = User::where('role_id',1)
        ->first();

        $request = [
            'name' => 'userTesting3AbisUpdate',
        ];

        $response = $this->actingAs($user)
        ->put(route('manajemen-user.update',15),$request);
        
        $response->assertStatus(302);
    }

    public function testUpdatePasswordUser()
    {
        $user = User::where('role_id',1)
        ->first();

        $request = [
            'name' => 'test Update Password', 
            'password' => 'userTesting12345',
            'password_confirmation' => 'userTesting12345',
        ];

        $response = $this->actingAs($user)
        ->put(route('manajemen-user.update',15),$request);
        
        $response->assertStatus(302);
    }

    public function testUpdateProfileByUser()
    {
        $user = User::where('email','unit@gmail.com')
        ->first();

        $request = [
            'name' => 'AdminSIM-A',
        ];

        $response = $this->actingAs($user)
        ->put(route('manajemen-profil.update',$user->id),$request);
        
        $response->assertStatus(302);
    }

    public function testUpdatePasswordByUser()
    {
        $user = User::where('email','unit@gmail.com')
        ->first();

        $request = [
            'name' => 'Unit abis ganti pass', 
            'password' => 'Unit12345',
            'password_confirmation' => 'Unit12345',
        ];

        $response = $this->actingAs($user)
        ->put(route('manajemen-profil.update',$user->id),$request);
        
        $response->assertStatus(302);
    }
}
