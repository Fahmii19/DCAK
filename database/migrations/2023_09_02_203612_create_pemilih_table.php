<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemilihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemilih', function (Blueprint $table) {
            $table->id('id_pemilih'); // Primary key dengan nama id_pemilih
            $table->string('nik'); // Kolom NIK (string)
            $table->string('nama_pemilih'); // Kolom nama pemilih (string)
            $table->string('no_hp'); // Kolom nomor HP (string)
            $table->string('rt'); // Kolom RT (string)
            $table->string('rw'); // Kolom RW (string)
            $table->string('tps'); // Kolom TPS (string)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemilih');
    }
}
