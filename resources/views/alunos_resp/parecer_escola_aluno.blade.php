@extends('layouts.app')

@section('content')
<div class="container">
   <div class="container-fluid">
            <div class="custom-container">
                <div class="custom-box">
                    <h5>Parecer da Escola/EMEI</h5>
                    <hr>
                         <div class="container justify-content-center">
                            <div class="row">
                                <div class="col-2">
                                    @if($alunos->tipo_aluno == 'ALUNO')
                                        <img src = "{{ asset('storage/alunos/'.$alunos->arquivo_aluno) }}" class="rounded-circle" style="max-width: 100%; height: 150px;">
                                    @else
                                        <img src = "{{ asset('storage/alunos/'.$alunos->arquivo_resp) }}" class="rounded-circle" style="max-width: 100%; height: 150px;">
                                    @endif
                                </div>
                                <div class="col">
                                    @if($alunos->tipo_aluno == 'ALUNO')
                                        <h5><strong>Nome: </strong>{{ $alunos->nome_aluno }}</h5>
                                        <h5><strong>CPF: </strong>{{ $alunos->cpf_aluno }}</h5>
                                        <h5><strong>Aluno: </strong>{{ $alunos->local_aluno }}</h5>
                                        <h5><strong>Série/Grupo: </strong>{{ $alunos->serie_aluno }}</h5>
                                    @else
                                        <h5><strong>Nome: </strong>{{ $alunos->nome_resp }}</h5>
                                        <h5><strong>CPF: </strong>{{ $alunos->cpf_resp }} - RG: {{ $alunos->rg_resp }}</h5>
                                        <h5><strong>Solicita acesso a: </strong>Escola / EMEI</h5>
                                        <h5><strong>Responsável pelo Aluno(a): </strong>{{ $alunos->nome_aluno_resp }}</h5>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <form method="POST" action="@if($alunos->tipo_aluno == 'ALUNO') {{ route('aluno_resp.motivo_escola_aluno') }} @else {{ route('aluno_resp.motivo_escola_resp') }} @endif" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="parecer_escola">PARECER</label>
                                            <select class="form-control" id="parecer_escola" name="parecer_escola" required>
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
                                            <label for="motivo_escola">Motivo</label>
                                            <textarea class="form-control" id="motivo_escola" rows="3" name="motivo_escola" required></textarea>
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
