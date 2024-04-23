
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-10">
            <h2>Lista de avisos</h2>
        </div>
    </div>
    <hr>
    
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        <hr>
    @endif
    
    <div class="row">
        @foreach($avisos as $a)
                <div class="col-md-4">
                    <div class="card text-black <?php if ($a->prioridade == 'Alta') {
                       echo 'border-danger';
                    }elseif ($a->prioridade == 'Baixa') {
                        echo 'border-success';
                    }elseif ($a->prioridade == 'Média') {
                        echo 'border-warning';
                    }?> mb-3" style="width: 20rem;">
                    <div class="card-header">Aviso nº: {{$a->id}}
                        @if($a->dono == Auth::user()->name || Auth::user()->autorizacao == 'ad')
                            <a title="Excluir" href="{{ route('avisos.delete', [$a->id]) }}">
                                <i class="fas fa-trash-alt" style="color: red; margin-left: 10rem;"></i>
                            </a>
                        @else

                        @endif
                    </div>                            
                      <div class="card-body">
                        <h5 class="card-title">{{$a->titulo}}</h5>
                        <div class="card-text">
                            <a title="Ver mensagem" href="#" data-toggle="modal" data-target="#ModalView-<?php echo $a->id; ?>">
                                Ver a mensagem ...
                            </a>
                        </div>
                      </div>
                    </div>
                </div>

                <!--MODAL QUE EXIBE O AVISO-->
                                <div class="modal fade" id="ModalView-<?=$a->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>{{$a->titulo}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <img src = "{{ asset('storage/avisos/'.$a->arquivo) }}" class="img-fluid" style="max-width: 100%;">
                                        {!! $a->mensagem !!}
                                        <hr>
                                        <h6><strong>Data da publicação:</strong> {{date('d/m/Y', strtotime($a->created_at))}}</h6>
                                        <h6><strong>Prioridade:</strong> {{$a->prioridade}}</h6>
                                        <h6><strong>Destinatário:</strong> {{$a->a_quem}}</h6>
                                        <h6><strong>Duração do aviso:</strong> {{$a->duracao}} dias - ( {{Carbon\Carbon::parse($a->created_at)->addDays($a->duracao)->format('d/m/Y')}} )</h6>
                                        <h6><strong>Publicado por:</strong> {{$a->dono}}</h6>
                                        @if($a->arquivo <> 'noimage.png')
                                            <a title="Baixar arquivo" href="{{ route('avisos.download', ['aviso' => $a->id]) }}">
                                                Baixar arquivo
                                            </a>
                                        @else
                                                            
                                        @endif
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--FIM DO MODAL-->
        @endforeach
    </div>
</div>
@endsection 