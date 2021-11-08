<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode');
            $table->string('nup');
            $table->string('uraian_barang');
            $table->string('jumlah');
            $table->bigInteger('harga_satuan');
            $table->bigInteger('harga_total');
            $table->bigInteger('nilai_tagihan');
            $table->string('tanggal_SP2D');
            $table->string('nomor_SP2D');
            $table->string('kelompok_belanja');
            $table->string('asal_perolehan');
            $table->string('nomor_bukti_perolehan');
            $table->string('merk');
            $table->string('sumber_dana');
            $table->string('pic');
            $table->string('kode_ruangan')->nullable();
            $table->string('kondisi');
            $table->string('unit');
            $table->string('gedung')->nullable();
            $table->string('ruangan')->nullable();
            $table->string('catatan')->nullable();
            $table->string('status_pengajuan');
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
        Schema::dropIfExists('data_pengajuans');
    }
}
