<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKantorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kantor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pt');
            $table->string('nama_cabang');
            $table->string('nama_aset');
            $table->string('nomor_aset');
            $table->string('kondisi')->default('Baik & Berfungsi');
            $table->string('informasi');
            $table->integer('tahun_perolehan');
            $table->integer('nilai_perolehan');
            $table->string('user');
            $table->softDeletes();
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
        Schema::dropIfExists('kantor');
    }
}
