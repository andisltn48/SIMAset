<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DataAset;
use Faker\Generator as Faker;

$factory->define(DataAset::class, function (Faker $faker) {
    return [
        'nama_barang' => $faker->title,
        'kode'=> $faker->title,
        'nup'=> $faker->title,
        'uraian_barang'=> $faker->title,
        'jumlah'=> $faker->title,
        'harga_satuan'=> $faker->title,
        'harga_total'=> $faker->title,
        'nilai_tagihan'=> $faker->title,
        'tanggal_SP2D'=> $faker->title,
        'nomor_SP2D'=> $faker->title,
        'kelompok_belanja'=> $faker->title,
        'asal_perolehan'=> $faker->title,
        'nomor_bukti_perolehan'=> $faker->title,
        'merk'=> $faker->title,
        'sumber_dana'=> $faker->title,
        'pic'=> $faker->title,
        'kode_ruangan'=> $faker->title,
        'kondisi'=> $faker->title,
        'unit'=> $faker->title,
        'status'=> $faker->title,
        'gedung'=> $faker->title,
        'ruangan'=> $faker->title,
        'catatan'=> $faker->title
    ];
});
