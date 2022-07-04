<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Superadmin',
            'email' => 'SAemailSecret@itk.ac.id',
            'password' => Hash::make('Sup3r4Dm1n'),
            'remember_token' => Str::random(50),
            'role_id' => '1',
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);
    }
}
