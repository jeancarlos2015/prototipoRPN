<li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-database"></i> Repositório: {!! $modelo->repositorio->nome !!}</a></li>
<li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-dashboard"></i> Painel</a></li>
<li class="breadcrumb-item "><a  href="{!! route('todos_projetos') !!}" > <i class="fa fa-project-diagram"></i> Processos</a></li>
<li class="breadcrumb-item "><a  href="{!! route('controle_modelos_index',[$modelo->codprojeto])!!}" > <i class="fa fa-project-diagram"></i> Processo: {!! $modelo->projeto->nome !!}</a></li>
<li class="breadcrumb-item"><a href="{!! route('controle_modelos_index',[$modelo->codprojeto]) !!}"><i class="fa fa-eye"></i> Modelos</a></li>
<li class="breadcrumb-item active"><a href="{!! route('controle_modelos_diagramaticos_index',[$modelo->codmodelo]) !!}"> <i class="fa fa-eye"></i>Modelo: {!! $modelo->nome !!}</a></li>


<div class="card text-white o-hidden h-100" style="background-color: #0b2e13">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5 text-center">PROCESSO: {!! strtoupper($modelo->projeto->nome) !!}</div>
        <div class="mr-5 text-center">MODELO: {!! strtoupper($modelo->nome) !!}</div>
        <div class="mr-5 text-center">DIAGRAMAS: {!! $modelo->qt_representacoes()!!} </div>
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! URL::previous()!!}">
             <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
    </a>

</div>
