<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = array('Super Admin','Admin','BMN','Sarpras','Peminjam','Pengaju');
        foreach ($name as $value) {
            DB::table('roles')->insert([
                'name' => $value,
            ]);
        }
    }
}
