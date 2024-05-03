@if(Auth::user()->funcao == 'in')
<p>
    <div class="row justify-content-center text-center">
        <div class="col-lg-4 d-flex justify-content-center text-center" style="width: 280px;">
            <a href="{{route('usuarios.index')}}" class="btn visitante2 btn-secondary" style="background-color: indianred; border-color: indianred;">
              <i class="fa fa-user-secret fa-2x"></i><br/>
                Usuários
            </a>
        </div>
    </div>
</p>
@endif
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center text-center">
          <p>
            @php
              $nascimento = Carbon\Carbon::parse(Auth::user()->nascimento);
              $idade = Carbon\Carbon::now()->diffInYears($nascimento);
            @endphp
            @if($idade >= 18)
              <a href="{{route('liberacao.create')}}" class="btn visitante btn-primary">
                <i class="fa fa-user-plus fa-2x"></i><br/>
                  Visitante
              </a>
            @endif
            <a href="{{route('ocorrencias.create')}}" class="btn btn-sq-sm btn-success">
                <i class="fas fa-exclamation-triangle fa-2x"></i>
              Ocorrência 
            </a>
            <a href="{{route('pets.create')}}" class="btn btn-info pq">
              <i class="fa fa-dog fa-2x"></i><br/>
              Pets
            </a>
            <a href="{{route('avisos.index')}}" class="btn btn-warning pq">
              <i class="fa fa-newspaper fa-2x"></i><br/>
              Avisos
            </a>
          </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center text-center">
          <p>
            <a href="{{route('usuarios.index')}}" class="btn btn-secondary pq" style="background-color: #3e3e3e; border-color: #000000;">
              <i class="fas fa-file-alt fa-2x"></i><br/>
                Documentos
            </a>
            <a href="{{route('desenv')}}" class="btn btn-warning pq" style="background-color: burlywood; border-color: burlywood;">
              <i class="fa fa-comments fa-2x"></i><br/>
              Fale com
            </a>
            <a href="{{ route('sair') }}" class="btn btn-warning pq" style="background-color: red; border-color: red;">
              <i class="fa fa-door-open fa-2x"></i><br/>
              Sair
            </a>
          </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center text-center">
          <p>
            <a href="{{ route('qrcode_organico', [Auth::user()->id]) }}" class="btn qrcode" style="background-color: black; border-color: black; color: white;">
              <i class="fa fa-qrcode fa-2x"></i><br/>
                MEU QRCODE
            </a>
            <a href="{{ route('form.senha', [Auth::user()->id]) }}" class="btn qrcode" style="background-color: grey; border-color: black; color: white;">
              <i class="fa fa-key fa-2x"></i><br/>
                SENHA
            </a>
            <a href="{{ route('form.senha', [Auth::user()->id]) }}" class="btn qrcode" style="background-color: white; border-color: black; color: black;">
              <i class="fas fa-user-edit fa-2x"></i><br/>
                Meus dados
            </a>
          </p>
        </div>
    </div>