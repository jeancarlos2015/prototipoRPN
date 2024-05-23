<ol class="breadcrumb" style="margin-top: 1%">

    <li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-database faa-pulse "></i> Repositório: {!! $repositorio->nome !!}</a></li>
    <li class="breadcrumb-item"><a  href="{!! route('painel') !!}" ><i class="fa fa-dashboard faa-pulse "></i> Painel</a></li>
    <li class="breadcrumb-item active"><a  href="{!! route('todos_projetos') !!}" > <i class="fa fa-project-diagram faa-pulse "></i> Processos</a></li>

    {{--                @if(!empty($branch_atual))--}}
    {{--                    <li class="breadcrumb-item">{!! $sub_titulo !!}</li>--}}
    {{--                    <li class="breadcrumb-item active"> Branch Atual / {!! $branch_atual !!}</li>--}}
    {{--                @else--}}
    {{--                    <li class="breadcrumb-item active">--}}
    {{--                        {!! $sub_titulo !!}--}}
    {{--                    </li>--}}
    {{--                @endif--}}
</ol>

<div class="card text-white o-hidden h-100" style="background-color: #1e4c4a">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list faa-pulse "></i>
        </div>
        <div class="mr-5 text-center">{!! $repositorio->qt_projetos()!!} Processos</div>
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! URL::previous()!!}">
              <span class="float-left">
                <i class="fa fa-hand-o-left faa-pulse "> Voltar</i>
              </span>
    </a>
</div>
