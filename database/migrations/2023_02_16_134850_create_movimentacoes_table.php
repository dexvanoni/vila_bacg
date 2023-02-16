<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimentacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_qr_vis')->nullable();
            $table->integer('id_qr_org')->nullable();
            $table->integer('id_portao')->nullable();
            $table->date('dt_entrada')->nullable();
            $table->date('dt_saida')->nullable();
            $table->time('hr_entrada')->nullable();
            $table->time('hr_saida')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('movimentacoes');
    }
}
