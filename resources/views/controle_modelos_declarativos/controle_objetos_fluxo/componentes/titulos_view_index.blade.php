<div class="card text-white o-hidden h-100" style="background-color: #985f0d">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5 text-center">PROJETO {!! strtoupper($modelo_declarativo->projeto->nome) !!}</div>
        <div class="mr-5 text-center">{!! count($modelo_declarativo->objetos_fluxos) !!} OBJETOS DE FLUXOS</div>
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! route('painel') !!}">
          <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
    </a>
</div>