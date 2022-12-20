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
        Schema::create('pendataan_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('Tlahir');
            $table->integer('umur');
            $table->integer('NoKtp');
            $table->integer('NoBpjs');
            $table->string('jk');
            $table->string('agama');
            $table->string('goldar');
            $table->string('PenTrakhir');
            $table->string('pekerjaan');
            $table->integer('NoTlp');
            $table->string('email')->unique();
            $table->string('metodeP');
            $table->string('Ttinggal');
            $table->string('AnggotaKel');
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
        Schema::dropIfExists('pendataan_pasiens');
    }
};
