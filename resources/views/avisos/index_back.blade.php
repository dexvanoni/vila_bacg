@extends('layouts.app')

@section('datatables')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <img src="/imagens/sisvila2.png" width="80px" height="70px">    
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mural de avisos ACVBA</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="lista_avisos" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Publicado em</th>
                                <th>Emissor</th>
                                <th>Duração</th>
                                <th>Assunto</th>
                                <th>Destinatário</th>
                                <th>Arquivo</th>
                                <th>Prioridade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($avisos as $a)
                            
                                <tr>
                                    <td>{{date('d/m/Y', strtotime($a->created_at))}}</td>
                                    <td>{{$a->dono}}</td>
                                    <td>{{$a->duracao}} dias</td>
                                    <td>
                                        {{substr($a->titulo, 0, 30)}} ...
                                        <a title="Ver mensagem" href="#" data-toggle="modal" data-target="#ModalView-<?php echo $a->id; ?>">
                                            <i class="fas fa-book-open"></i>
                                        </a>
                                    </td>
                                    <td>{{$a->a_quem}}</td>
                                    <td>
                                        @if($a->arquivo <> 'noimage.png')
                                         <a href="{{ route('avisos.download', ['aviso' => $a->id]) }}">
                                            <i class="fas fa-download"></i>
                                            </a>
                                        @else
                                            
                                        @endif
                                    </td>
                                    <td>{{$a->prioridade}}</td>
                                </tr>
                                <!--MODAL QUE EXBE O AVISO-->
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
                                        {!! $a->mensagem !!}
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <!--FIM DO MODAL-->
                            @endforeach
                        </tbody>
                        
                    </table>

                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('script_datatable')
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#lista_avisos').DataTable({
                 responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Details for '+data[0]+' '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                }
            });
        });
    </script>

@endsection