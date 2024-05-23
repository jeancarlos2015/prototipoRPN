<div class="card text-white o-hidden h-100" style="background-color: #0b2e13">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
        </div>
        <h3 class="text-center">Alterações do Modelo</h3>
        <div class="mr-5 text-center">PROJETO: {!! strtoupper($representacao_diagramatica->modelo->projeto->nome) !!}</div>
        <div class="mr-5 text-center">MODELO: {!! strtoupper($representacao_diagramatica->modelo->nome) !!}</div>
        <div class="mr-5 text-center">DIAGRAMAS: {!! $representacao_diagramatica->modelo->qt_representacoes()!!} </div>
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! URL::previous()!!}">
             <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
    </a>

</div>