@if(Auth::user()->funcao == 'in')
<div class="row">
  <div class="col-lg-12 d-flex justify-content-center text-center">
    <h5>EMITIR PARECER (SINT)</h5>
  </div>
</div>
<div class="row">
        <div class="col-lg-12 d-flex justify-content-center text-center">
          <p>
            <a href="{{ route('aluno_resp.index') }}" class="btn md" style="background-color: orange; border-color: black; color: black;">
              <i class="fas fa-user-graduate"></i><br/>
                ALUNOS
            </a>
            <a href="{{ route('aluno_resp.index_resp') }}" class="btn md" style="background-color: grey; border-color: black; color: white;">
              <i class="fas fa-people-arrows"></i><br/>
                RESPONSÁVEIS
            </a>
          </p>
        </div>
    </div>
    <hr>
@endif
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center text-center">
          <p>
            <a href="{{ route('qrcode_organico', [Auth::user()->id]) }}" class="btn pq" style="background-color: black; border-color: black; color: white;">
              <i class="fa fa-qrcode fa-2x"></i><br/>
                MEU QRCODE
            </a>
            <a href="{{ route('form.senha', [Auth::user()->id]) }}" class="btn pq" style="background-color: grey; border-color: black; color: white;">
              <i class="fa fa-key fa-2x"></i><br/>
                SENHA
            </a>
            <a href="{{ route('usuarios.edit', [Auth::user()->id]) }}" class="btn pq" style="background-color: white; border-color: black; color: black;">
              <i class="fas fa-user-edit fa-2x"></i><br/>
                Meus dados
            </a>
            <a href="{{ route('sair') }}" class="btn btn-warning pq" style="background-color: red; border-color: red;">
              <i class="fa fa-door-open fa-2x"></i><br/>
              Sair
            </a>
          </p>
        </div>
    </div>