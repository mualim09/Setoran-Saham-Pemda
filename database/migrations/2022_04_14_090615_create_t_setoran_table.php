<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSetoranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_setoran', function (Blueprint $table) {
            $table->id();
            $table->integer('pemda_id');
            $table->double('nominal_setoran');
            // $table->double('total_setoran');
            $table->date('tanggal_setoran');
            $table->integer('triwulan');
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
        Schema::dropIfExists('t_setoran');
    }
}
