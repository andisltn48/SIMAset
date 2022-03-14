<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IterasiPertama extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function validate_login()
    {
        
        $value = [
            'email' => 'superadmin@student.itk.ac.id',
            'password' => 'Superadmin12345'
        ];
        try {
    
            $this->get(route('pengajuan.form'))->assertStatus(200);
        } catch (MySpecificException $e) {
            $this->assertEquals("Exception Message", $e->getMessage());
            
        }
    }

    // public function register()
    // {
    //     # code...
    // }
}
