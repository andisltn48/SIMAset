<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailLogImportPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_log_import_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('row')->nullable();
            $table->string('nama')->nullable();
            $table->string('status');
            $table->string('message');
            $table->string('import_id');
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
        Schema::dropIfExists('detail_log_import_pengajuan');
    }
}
