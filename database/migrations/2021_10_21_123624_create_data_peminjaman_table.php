<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('nama_penanggung_jawab');
            $table->string('nama_barang');
            $table->bigInteger('kode_barang');
            $table->string('nup_barang');
            $table->string('kondisi');
            $table->string('tanggal_penggunaan');
            $table->string('surat_peminjaman');
            $table->string('surat_balasan');
            $table->string('data_diri_penanggung_jawab');
            $table->string('status_peminjaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_peminjamen');
    }
}
