<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDcakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_dcak', function (Blueprint $table) {
            $table->id('id_users_dcak');  // Primary key
            $table->unsignedBigInteger('id_koordinator')->nullable();  // Foreign key
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();

            // Menetapkan foreign key constraint.
            $table->foreign('id_koordinator')->references('id_koordinator')->on('koordinator')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_dcak');
    }
}
