@if(!empty($repositorio))
    <li class="breadcrumb-item"><a href="{!! route('painel') !!}"><i class="fa fa-database"></i>
            Repositório: {!! $repositorio->nome !!}</a></li>
@endif
<li class="breadcrumb-item"><a href="{!! route('painel') !!}"><i class="fa fa-dashboard"></i> Painel</a></li>
<li class="breadcrumb-item active"><a href="{!! route('todos_projetos') !!}"> <i class="fa fa-project-diagram"></i>
        Processos</a></li>

<div class="card text-white o-hidden h-100" style="background-color: #1e4c4a">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
        </div>
        @if(!empty($projetos))
            <div class="mr-5"> {!! count($projetos)!!} Processos</div>
        @else
            <div class="mr-5">0 Processos</div>
        @endif
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! route('painel') !!}">
              <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
    </a>
</div>