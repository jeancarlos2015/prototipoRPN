@if(!empty($repositorio))
    <li class="breadcrumb-item"><a href="{!! route('painel') !!}"><i class="fa fa-database"></i>
            Repositório: {!! $repositorio->nome !!}</a></li>
@endif
<li class="breadcrumb-item"><a href="{!! route('painel') !!}"><i class="fa fa-dashboard"></i> Painel</a></li>
<li class="breadcrumb-item active"><a href="{!! route('todos_modelos') !!}"> <i class="fa fa-project-diagram"></i>
        Modelos</a></li>
<div class="card text-white o-hidden h-100" style="background-color: #1e4c4a">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
        </div>
        @if(Auth::user()->usuario_esta_no_repositorio())
            <div class="mr-5 text-center">{!! count($repositorio->modelos) !!} MODELOS</div>
        @else
            <div class="mr-5 text-center">{!! count(Auth::user()->todos_modelos()) !!} MODELOS</div>
        @endif
    </div>
    <a class="card-footer text-white clearfix small z-1"
       href="{!! route('painel') !!}">
            <span class="float-left">
                <i class="fa fa-hand-o-left"> Voltar</i>
              </span>
    </a>
</div>