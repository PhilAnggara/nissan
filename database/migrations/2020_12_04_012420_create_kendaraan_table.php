<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('area');
            $table->string('merk');
            $table->string('model');
            $table->integer('isi_silinder');
            $table->string('transmisi');
            $table->string('no_polisi');
            $table->integer('tahun_produksi');
            $table->string('warna');
            $table->string('no_chasis');
            $table->string('no_engine');
            $table->date('jatuh_tempo_stnk')->nullable();
            $table->date('waktu_pembelian');
            $table->integer('harga_perolehan');
            $table->integer('nvb')->nullable();
            $table->string('kondisi')->default('Baik & Berfungsi');
            $table->integer('status_pajak'); // 0, 1, 2
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
        Schema::dropIfExists('kendaraan');
    }
}
