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
            $table->bigInteger('id_peminjam');
            $table->string('nama_penanggung_jawab');
            $table->bigInteger('no_peminjaman');
            $table->string('tanggal_awal_penggunaan');
            $table->string('tanggal_akhir_penggunaan');
            $table->string('jumlah');
            $table->string('surat_peminjaman');
            $table->string('surat_balasan');
            $table->string('data_diri_penanggung_jawab');
            $table->string('status_permintaan');
            $table->string('status_peminjaman');
            $table->string('saran')->nullable();
            $table->string('catatan')->nullable();
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
