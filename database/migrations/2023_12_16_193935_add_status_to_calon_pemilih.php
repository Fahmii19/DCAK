<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCalonPemilih extends Migration
{
    public function up()
    {
        Schema::table('calon_pemilih', function (Blueprint $table) {
            $table->string('status')->nullable()->after('kelurahan');
        });
    }

    public function down()
    {
        Schema::table('calon_pemilih', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
