<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSaldoAkhirTable extends Migration
{
    /**
     * Run the migratioSns.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_saldo_akhir', function (Blueprint $table) {
            $table->id();
            $table->integer('pemda_id');
            $table->integer('tahun');
            $table->double('triwulan1');
            $table->double('triwulan2');
            $table->double('triwulan3');
            $table->double('triwulan4');
            $table->double('total_akhir');
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
        Schema::dropIfExists('t_saldo_akhir');
    }
}
