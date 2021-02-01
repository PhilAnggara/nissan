<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeralatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peralatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_cabang');
            $table->string('nama_pt');
            $table->string('area');
            $table->string('jenis_aset');
            $table->integer('tahun_perolehan');
            $table->integer('nilai_perolehan');
            $table->integer('nilai_buku')->nullable();
            $table->string('user');
            $table->string('status');
            $table->string('kondisi')->default('Baik & Berfungsi');
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
        Schema::dropIfExists('peralatan');
    }
}
