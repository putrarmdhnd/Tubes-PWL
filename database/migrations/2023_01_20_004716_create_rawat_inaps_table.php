<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_inaps', function (Blueprint $table) {
            $table->id();
            $table->integer('pemeriksaan_id');
            $table->string('nama_pasien');
            $table->integer('kelas');
            $table->string('nama_ruangan');
            $table->timestamps();

            $table->foreign('pemeriksaan_id')->references('id')->on('pemeriksaans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rawat_inaps');
    }
};
