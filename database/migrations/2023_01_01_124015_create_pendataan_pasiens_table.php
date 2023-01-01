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
            $table->bigInteger('umur');
            $table->bigInteger('NoKtp');
            $table->string('jk');
            $table->string('goldar');
            $table->string('pekerjaan');
            $table->bigInteger('NoTlp');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->bigInteger('TBadan');
            $table->bigInteger('BBadan');
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
