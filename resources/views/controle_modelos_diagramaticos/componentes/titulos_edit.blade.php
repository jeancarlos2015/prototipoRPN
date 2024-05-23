<li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-database"></i> Repositório: {!! $representacao_diagramatica->repositorio->nome !!}</a></li>
<li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-dashboard"></i> Painel</a></li>
<li class="breadcrumb-item "><a  href="{!! route('todos_projetos') !!}" > <i class="fa fa-project-diagram"></i> Processos</a></li>
<li class="breadcrumb-item "><a  href="{!! route('controle_modelos_index',[$representacao_diagramatica->codprojeto])!!}" > <i class="fa fa-project-diagram"></i> Processo: {!! $representacao_diagramatica->projeto->nome !!}</a></li>
<li class="breadcrumb-item"><a href="{!! route('controle_modelos_index',[$representacao_diagramatica->codprojeto]) !!}"><i class="fa fa-eye"></i> Modelos</a></li>
<li class="breadcrumb-item"><a href="{!! route('controle_modelos_index',[$representacao_diagramatica->codprojeto]) !!}"><i class="fa fa-eye"></i> Modelo: {!!$representacao_diagramatica->modelo->nome  !!}</a></li>
<li class="breadcrumb-item"><a href="{!! route('controle_modelos_diagramaticos_index',[$representacao_diagramatica->codmodelo]) !!}"> <i class="fa fa-eye"></i> Diagramas</a></li>

<li class="breadcrumb-item"><a  href="#" > <i class="fa fa-pencil"></i> Edição de Diagramas</a></li>
<li class="breadcrumb-item active"><a  href="#" > <i class="fa fa-pencil"></i> Diagrama: {!! $representacao_diagramatica->nome !!}</a></li>

<div class="card text-white o-hidden h-100" style="background-color: #0b2e13">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5 text-center">PROJETO {!! strtoupper($representacao_diagramatica->modelo->projeto->nome) !!}</div>
        <div class="mr-5 text-center">DIAGRAMAS: {!! $representacao_diagramatica->modelo->qt_representacoes()!!} </div>
        <div class="mr-5 text-center">EDIÇÃO DO DIAGRAMA {!! $representacao_diagramatica->nome!!} </div>
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! URL::previous()!!}">
              <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
    </a>

</div>
