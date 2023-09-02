<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCalonPemilihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('calon_pemilih', function (Blueprint $table) {
            $table->string('nik')->nullable()->change();
            $table->string('nama_pemilih')->nullable()->change();
            $table->string('no_hp')->nullable()->change();
            $table->string('rt')->nullable()->change();
            $table->string('rw')->nullable()->change();
            $table->string('tps')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
