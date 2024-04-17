<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CadAluno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_aluno');
            $table->string('local_aluno');
            $table->string('dt_nascimento_aluno');
            $table->string('serie_aluno');
            $table->string('cpf_aluno');
            $table->string('rg_aluno');
            $table->string('endereco_aluno');
            $table->string('cep_aluno');
            $table->string('arquivo_aluno');
            $table->string('nome_resp');
            $table->string('cpf_resp');
            $table->string('rg_resp');
            $table->string('num_cnh_resp');
            $table->string('tipo_cnh_resp');
            $table->string('validade_cnh_resp');
            $table->string('endereco_resp');
            $table->string('cep_resp');
            $table->string('arquivo_resp');
            $table->string('tel_resp');
            $table->string('email_resp')->unique();;
            $table->string('status');
            $table->string('tipo');
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
        Schema::table('alunos', function (Blueprint $table) {
            //
        });
    }
}
