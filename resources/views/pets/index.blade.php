@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2">
            <img src="/imagens/sisvila2.png" width="80px" height="70px">        
        </div>
        <div class="col-md-12">
            <h2>Pets Cadastrados</h2>
        </div>
    </div>
    <hr>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        <hr>
    @endif
    
    <div class="row text-center h-100">
        @foreach($pets as $a)
                <div class="col-md-12 text-center my-auto">
                    <div class="card d-flex text-black <?php if ($a->porte == 'GRANDE') {
                       echo 'border-danger';
                    }elseif ($a->porte == 'PEQUENO') {
                        echo 'border-success';
                    }elseif ($a->porte == 'MÉDIO') {
                        echo 'border-warning';
                    }?> mb-4" style="width: 15rem;">
                    <div class="card-header">{{$a->tipo}}: {{$a->coleira}}
                        @if($a->dono == Auth::user()->name || Auth::user()->autorizacao == 'ad')
                            <a title="Excluir" href="{{ route('pets.delete', [$a->id]) }}">
                                <i class="fas fa-trash-alt" style="color: red; margin-left: 2rem;"></i>
                            </a>
                        @endif
                        @if($a->arquivo)
                            <a title="Ver imagem em tamanho real" href="#" data-toggle="modal" data-target="#FotoView-<?php echo $a->id; ?>">
                                <i class="fas fa-camera" style="color: blue; margin-left: 1rem;"></i>
                            </a>
                        @endif
                    </div>                            
                      <div class="card-body align-items-center d-flex justify-content-center">
                        <div class="card-text">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src = "{{ asset('storage/pets/'.$a->arquivo) }}" class="rounded-circle shadow-4-strong" style="width: 40px; height: 40px;">
                                </div>
                                <div class="col-md-9">
                                    <a title="Ver mensagem" href="#" data-toggle="modal" data-target="#ModalView-<?php echo $a->id; ?>">
                                Ver esse pet ...
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                      </div>
                    </div>
                </div>

                <!--MODAL QUE EXIBE O PET-->
                                <div class="modal fade" id="ModalView-<?=$a->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>{{$a->tipo}}: {{$a->coleira}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row justify-content-center">
                                            <img src = "{{ asset('storage/pets/'.$a->arquivo) }}" class="img-fluid" style="max-width: 30%;">    
                                        </div>
                                        <hr>
                                        <h6><strong>DONO:</strong> {{$a->dono}}</h6>
                                        <h6><strong>Endereço:</strong> 
                                            @php
                                                $endereco = DB::table('users')->where('name', $a->dono)->first();
                                            @endphp
                                            {{$endereco->local}}
                                        </h6>
                                        <h6><strong>Contato:</strong> {{$a->contato}}</h6>
                                        <h6><strong>Atende pelo nome:</strong> {{$a->coleira}}</h6>
                                        <h6><strong>Tipo / Porte:</strong> {{$a->tipo}} - {{$a->porte}}</h6>
                                        <h6><strong>Raça:</strong> {{$a->raca}}</h6>
                                        <h6><strong>Cor:</strong> {{$a->cor}}</h6>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--FIM DO MODAL-->

                            <!--MODAL QUE EXIBE A foto-->
                                <div class="modal fade" id="FotoView-<?=$a->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle"><strong>{{$a->tipo}}: {{$a->coleira}}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <img src = "{{ asset('storage/pets/'.$a->arquivo) }}" class="img-fluid" style="max-width: 100%;">
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
