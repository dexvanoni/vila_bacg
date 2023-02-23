<?php

namespace App\Imports;

use App\Liberar;
use Auth;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Http\Request;


class VisitanteImport implements ToModel, WithHeadingRow
{

    use Importable;

        protected $destino;
        protected $lista;
        protected $observacao;
        protected $dt_entrada;
        protected $hr_entrada;
        protected $dt_saida;
        protected $hr_saida;
        protected $status;

        
    
    public function rules(): array
    {
        return [
            'nome_completo' => [
                'required',
                'string',
            ],
            'documento' => [
                'required',
            ],
        ];
    }

        public function __construct($lista, $destino, $observacao, $dt_entrada, $hr_entrada, $dt_saida, $hr_saida, $status) 
    {
        
        $this->destino = $destino;
        $this->lista = $lista;
        $this->observacao = $observacao;
        $this->dt_entrada = $dt_entrada;
        $this->hr_entrada = $hr_entrada;
        $this->dt_saida = $dt_saida;
        $this->hr_saida = $hr_saida;
        $this->status = $status;

    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         if(!array_filter($row)) {
             return null;
        } 

        return new Liberar([
          'apelido' => $row['nome_completo'],
          'nome_completo' => $row['nome_completo'],
          'doc' => $row['documento'],
          'contato' => $row['contato'],
          'funcao' => 'Convidado de Evento',
          'veiculo' => 'Lista',
          'cor_veiculo' => 'Lista',
          'liberador' => Auth::user()->name,
          'destino' => $this->destino,
          'lista' => $this->lista,
          'dt_entrada' => $this->dt_entrada,
          'dt_saida' => $this->dt_saida,
          'hr_entrada' => $this->hr_entrada,
          'hr_saida' => $this->hr_saida,
          'status' => 'Liberado',
          'observacao' => 'Lista de ingresso',
          'onesignal_id' => Auth::user()->id,
          'movimentacao' => 'A'
        ]);
    }
}
