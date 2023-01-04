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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->string('keluhan')->bigstring();
            $table->string('keterangan_penyakit');
            $table->string('resep_obat');
            $table->integer('status_dirawat');
            $table->integer('pasien_id');
            $table->timestamps();

            $table->foreign('pasien_id')->references('id')->on('pendataan_pasiens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
