<div class="card text-white o-hidden h-100" style="background-color: #985f0d">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5 text-center">PROCESSO {!! strtoupper($objeto_fluxo->projeto->nome) !!}</div>
        <div class="mr-5 text-center">Representação Declarativa {!! strtoupper($objeto_fluxo->modelo->nome) !!}</div>
        <div class="mr-5 text-center">EDITAR OBJETO DE FLUXO {!! strtoupper($objeto_fluxo->nome) !!}</div>
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! route('painel') !!}">
              <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
    </a>
</div>