<li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-database faa-pulse "></i> Repositório: {!! $projeto->repositorio->nome !!}</a></li>
<li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-dashboard faa-pulse "></i> Painel</a></li>
<li class="breadcrumb-item "><a  href="{!! route('todos_projetos') !!}" > <i class="fa fa-project-diagram faa-pulse "></i> Processos</a></li>

<li class="breadcrumb-item "><a  href="#" > <i class="fa fa-pencil faa-pulse "></i> Edição de Processo</a></li>
<li class="breadcrumb-item active"><a  href="#" > <i class="fa fa-pencil faa-pulse "></i>Processo: {!! $projeto->nome !!}</a></li>

<div class="card text-white o-hidden h-100" style="background-color: #1e4c4a">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list faa-pulse "></i>
        </div>
        <div class="mr-5 text-center">REPOSITÓRIO {!! strtoupper($projeto->repositorio->nome) !!} </div>
        <div class="mr-5 text-center">EDIÇÃO DO PROCESSO {!! strtoupper($projeto->nome) !!}</div>
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! URL::previous()!!}">
               <span class="float-left">
                <i class="fa fa-hand-o-left faa-pulse "> Voltar</i>
              </span>
    </a>
</div>
