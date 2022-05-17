<?php

namespace Tests\Unit\IterasiPertama;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DeleteDataAsetTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDeleteDataAset()
    {
        $user = User::where('role_id',1)
        ->orWhere('role_id',2)
        ->orWhere('role_id',3)
        ->first();

        // dd($user);

        
        $response = $this->actingAs($user)->delete(route('data-aset.destroy',19));
        
        $response->assertStatus(500);
    }
}
