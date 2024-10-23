<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\CadAluno;
class UpdateSerieJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Atualizando o grupo da EMEI
        CadAluno::where('serie_aluno', 'Grupo 2')->update(['serie_aluno' => 'Grupo 3']);
        CadAluno::where('serie_aluno', 'Grupo 3')->update(['serie_aluno' => 'Grupo 4']);
        CadAluno::where('serie_aluno', 'Grupo 4')->update(['serie_aluno' => 'Grupo 5']);

        // Terminado o grupo 5 o aluno é colocado na tabela de desativados
        CadAluno::where('serie_aluno', 'Grupo 5')->update(['status_aluno' => '2']);

        // Atualizando a série da Escola
        CadAluno::where('serie_aluno', '1º Ano A')->update(['serie_aluno' => '2º Ano A']);
        CadAluno::where('serie_aluno', '1º Ano B')->update(['serie_aluno' => '2º Ano B']);

        CadAluno::where('serie_aluno', '2º Ano A')->update(['serie_aluno' => '3º Ano A']);
        CadAluno::where('serie_aluno', '2º Ano B')->update(['serie_aluno' => '3º Ano B']);

        CadAluno::where('serie_aluno', '3º Ano A')->update(['serie_aluno' => '4º Ano A']);
        CadAluno::where('serie_aluno', '3º Ano B')->update(['serie_aluno' => '4º Ano B']);

        CadAluno::where('serie_aluno', '4º Ano A')->update(['serie_aluno' => '5º Ano A']);
        CadAluno::where('serie_aluno', '4º Ano B')->update(['serie_aluno' => '5º Ano B']);

        CadAluno::where('serie_aluno', '5º Ano A')->update(['serie_aluno' => '6º Ano A']);
        CadAluno::where('serie_aluno', '5º Ano B')->update(['serie_aluno' => '6º Ano B']);

        CadAluno::where('serie_aluno', '6º Ano A')->update(['serie_aluno' => '7º Ano A']);
        CadAluno::where('serie_aluno', '6º Ano B')->update(['serie_aluno' => '7º Ano B']);

        CadAluno::where('serie_aluno', '7º Ano A')->update(['serie_aluno' => '8º Ano A']);
        CadAluno::where('serie_aluno', '7º Ano B')->update(['serie_aluno' => '8º Ano B']);

        CadAluno::where('serie_aluno', '8º Ano A')->update(['serie_aluno' => '9º Ano A']);
        CadAluno::where('serie_aluno', '8º Ano B')->update(['serie_aluno' => '9º Ano B']);

        // Terminado o 9º Ano o aluno é colocado na tabela de desativados
        CadAluno::where('serie_aluno', '9º Ano A')->update(['status_aluno' => '2']);
        CadAluno::where('serie_aluno', '9º Ano B')->update(['status_aluno' => '2']);

    }
}
