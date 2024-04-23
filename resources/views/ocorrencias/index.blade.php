@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row align-items-center">
		<div class="col-md-2">
			<img src="/imagens/sisvila2.png" width="80px" height="70px">        
		</div>
		<div class="col-md-10">
			<h2>Lista de ocorrências</h2>
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
		@foreach($ocorrencias as $a)
				<div class="col-md-4">
					<div class="card text-black <?php if ($a->prioridade == 'Alta') {
					   echo 'border-danger';
					}elseif ($a->prioridade == 'Baixa') {
						echo 'border-success';
					}elseif ($a->prioridade == 'Média') {
						echo 'border-warning';
					}?> mb-4" style="width: 15rem;">
					<div class="card-header">Ocorrência nº: {{$a->id}}
						@if($a->dono == Auth::user()->name || Auth::user()->autorizacao == 'ad')
							<a title="Excluir" href="{{ route('ocorrencias.delete', [$a->id]) }}">
								<i class="fas fa-trash-alt" style="color: red; margin-left: 2rem;"></i>
							</a>
						@else

						@endif
						@if($a->arquivo)
							<a title="Ver imagem em tamanho real" href="#" data-toggle="modal" data-target="#FotoView-<?php echo $a->id; ?>">
								<i class="fas fa-camera" style="color: blue; margin-left: 1rem;"></i>
							</a>
						@else

						@endif
					</div>                            
					  <div class="card-body">
						<div class="card-text">
							<a title="Ver mensagem" href="#" data-toggle="modal" data-target="#ModalView-<?php echo $a->id; ?>">
								Ver a mensagem ...
							</a>
						</div>
					  </div>
					</div>
				</div>

				<!--MODAL QUE EXIBE A OCORRENCIA-->
								<div class="modal fade" id="ModalView-<?=$a->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalScrollableTitle"><strong>ocorrência nº {{$a->id}}</strong></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<div class="row justify-content-center">
											<img src = "{{ asset('storage/ocorrencias/'.$a->arquivo) }}" class="img-fluid" style="max-width: 30%;">    
										</div>
										<br>
										<div class="row">
											{!! $a->mensagem !!}
										</div>
										<hr>
										<h6><strong>Data da publicação:</strong> {{date('d/m/Y', strtotime($a->created_at))}}</h6>
										<h6><strong>Prioridade:</strong> {{$a->prioridade}}</h6>
										<h6><strong>Destinatário:</strong> {{$a->a_quem}}</h6>
										<h6><strong>Publicado por:</strong> {{$a->dono}}</h6>
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
										<h5 class="modal-title" id="exampleModalScrollableTitle"><strong>Ocorrência nº {{$a->id}}</strong></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<img src = "{{ asset('storage/ocorrencias/'.$a->arquivo) }}" class="img-fluid" style="max-width: 100%;">
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