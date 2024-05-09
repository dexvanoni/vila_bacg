@extends('layouts.app')

@section('content')
<div class="container">
   <div class="container-fluid">
            <div class="custom-container">
                <div class="custom-box">
                    <h5>Parecer da Seção de Inteligência da BACG</h5>
                    <hr>
                         <div class="container justify-content-center">
                         	@if($alunos->tipo_aluno == 'ALUNO')
	                            <h5>Nome: {{ $alunos->nome_aluno }}</h5>
	                            <h5>CPF: {{ $alunos->cpf_aluno }}</h5>
	                            <h5>Aluno da {{ $alunos->local_aluno }}</h5>
                            @else
	                            <h5>Nome: {{ $alunos->nome_resp }}</h5>
	                            <h5>CPF: {{ $alunos->cpf_resp }} - RG: {{ $alunos->rg_resp }}</h5>
	                            <h5>Solicita acesso a: Escola / EMEI</h5>
	                            <h5>Responsável pelo Aluno(a): {{ $alunos->nome_aluno_resp }}</h5>
                            @endif
                            <hr>
                            <form method="POST" action="@if($alunos->tipo_aluno == 'ALUNO') {{ route('aluno_resp.motivo_sint_aluno') }} @else {{ route('aluno_resp.motivo_sint_resp') }} @endif" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="parecer_sint">PARECER</label>
                                            <select class="form-control" id="parecer_sint" name="parecer_sint" required>
                                                    <option value="c">Clique aqui...</option>
                                                    <option style="color: green" value="APROVADO">APROVADO</option>
                                                    <option style="color: red" value="RECUSADO">RECUSADO</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="motivo_sint">Motivo</label>
                                            <textarea class="form-control" id="motivo_sint" rows="3" name="motivo_sint" required></textarea>
                                        </div> 
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $alunos->id }}" name="id"></input>
                                <div class="row" style="margin-top: 30px;">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            Enviar
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </form>
                          </div>
                </div>
            </div>
        </div>
@endsection
