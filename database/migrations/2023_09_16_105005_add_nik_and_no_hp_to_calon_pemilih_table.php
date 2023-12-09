<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNikAndNoHpToCalonPemilihTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon_pemilih', function (Blueprint $table) {
            $table->string('nik')->nullable()->after('id_calon_pemilih');
            $table->string('no_hp', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calon_pemilih', function (Blueprint $table) {
            $table->dropColumn('nik');
            $table->string('no_hp')->change();
        });
    }
}
