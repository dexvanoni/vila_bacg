@if(Auth::user()->funcao == 'ape' || Auth::user()->funcao == 'api')
<p>
    <div class="row justify-content-center text-center">
        <div class="col-lg-12 d-flex justify-content-center text-center" style="width: 370px;">
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
            <a href="{{ route('qrcode_organico', [Auth::user()->id]) }}" class="btn pq" style="background-color: black; border-color: black; color: white;">
              <i class="fa fa-qrcode fa-2x"></i><br/>
                MEU QRCODE
            </a>
            <a href="{{ route('form.senha', [Auth::user()->id]) }}" class="btn pq" style="background-color: grey; border-color: black; color: white;">
              <i class="fa fa-key fa-2x"></i><br/>
                SENHA
            </a>
            <a href="{{ route('form.senha', [Auth::user()->id]) }}" class="btn pq" style="background-color: white; border-color: black; color: black;">
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
    @php
    // Obter o horário atual
    $currentDateTime = now(); // ou \Carbon\Carbon::now();

    // Obter o dia da semana (0 é domingo, 1 é segunda, ..., 6 é sábado)
    $dayOfWeek = $currentDateTime->dayOfWeek;

    // Obter a hora atual em formato 24 horas
    $currentHour = $currentDateTime->hour;

    // Verificar se é dia útil (segunda a sexta) e se está no intervalo de tempo das 6h às 18h
    $isWeekday = $dayOfWeek >= 1 && $dayOfWeek <= 5;
    $isInTimeRange = $currentHour >= 8 && $currentHour < 18;

    // Se for dia útil e estiver dentro do intervalo de tempo, mostrar o botão
    $showButton = $isWeekday && $isInTimeRange;
@endphp
@if ($showButton)
    <div class="row justify-content-center text-center">
        <div class="col-lg-12 d-flex justify-content-center text-center" style="width: 370px;">
            <a href="{{route('liberacao.create')}}" class="btn visitante2 btn-primary">
              <i class="fa fa-user-plus fa-2x"></i><br/>
                Visitante
            </a>
        </div>
    </div>
@endif