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
        $name = array('Super Admin','Admin','Sarpras','Peminjam','Unit');
        foreach ($name as $value) {
            DB::table('roles')->insert([
                'name' => $value,
            ]);
        }
    }
}
