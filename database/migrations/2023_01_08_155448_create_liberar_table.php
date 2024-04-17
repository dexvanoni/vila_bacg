<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiberarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_vis_entrada', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apelido');
            $table->string('nome_completo');
            $table->string('doc')->unique()->nullable();
            $table->string('funcao')->nullable();
            $table->string('veiculo')->nullable();
            $table->string('cor_veiculo')->nullable();
            $table->string('liberador');
            $table->string('destino');
            $table->date('dt_entrada');
            $table->date('dt_saida');
            $table->time('hr_entrada');
            $table->time('hr_saida');
            $table->string('status');
            $table->longText('observacao')->nullable();
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
        Schema::dropIfExists('cad_vis_entrada');
    }
}
