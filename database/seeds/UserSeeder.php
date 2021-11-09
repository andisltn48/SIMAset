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
            'email' => 'superadmin@itk.ac.id',
            'password' => Hash::make('Superadmin12345'),
            'remember_token' => Str::random(50),
            'role_id' => '1'
        ]);
    }
}
