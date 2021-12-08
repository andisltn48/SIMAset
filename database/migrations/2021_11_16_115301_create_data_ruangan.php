<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ruangan');
            $table->string('nama_ruangan');
            $table->string('pj');
            $table->bigInteger('nip');
            $table->bigInteger('kode_gedung');
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
        Schema::dropIfExists('data_ruangan');
    }
}
