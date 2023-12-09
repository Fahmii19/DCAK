<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCalonPemilihToPemilihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemilih', function (Blueprint $table) {
            $table->bigInteger('id_calon_pemilih')->nullable()->after('id_pemilih');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemilih', function (Blueprint $table) {
            $table->dropColumn('id_calon_pemilih');
        });
    }
}
