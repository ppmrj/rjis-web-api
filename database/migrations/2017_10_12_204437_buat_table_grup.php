<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTableGrup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grup', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_grup_line');
            $table->string('nama');
            $table->string('status_game');
            $table->string('tipe_grup');
            $table->integer('id_divisi');
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
        Schema::dropIfExists('grup');
    }
}
