@extends('layouts.admin.layouts.layout_projeto.main')
@section('content')

    <form action="{!! route('controle_mensagens_store') !!}" method="post">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="assunto">Assunto</label>
            <input type="text" class="form-control" value="RE: {!! $mensagem->assunto !!}" name="assunto">
        </div>
        <div class="form-group">
            <label for="texto">Texto</label>
            <textarea class="form-control" name="texto">{!! $mensagem->responsavel->name !!}:{!! $mensagem->texto !!}.</textarea>
        </div>
        <div class="form-group">
            <label for="usuarios">Destinatários</label>
            <div class="subject-info-box-1">
                <select multiple="multiple" class="form-control" name="codusuarios[]">
                    @foreach($usuarios as $usuario)
                        @if($usuario->codusuario==$mensagem->responsavel->codusuario)
                            <option selected value="{!! $usuario->codusuario !!}">{!! $usuario->name !!}</option>
                        @else
                            <option value="{!! $usuario->codusuario !!}">{!! $usuario->name !!}</option>
                        @endif

                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-dark form-control">Responder e encaminhar</button>
    </form>
@endsection

@section('titulo')
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
@endsection

@section('menu_usuarios')
    @if(Auth::getuser()->EstaLiberado())
        @if(!empty($repositorio))
            @includeIf('menu.componentes.menu_usuarios',[
            'entradas' => $repositorio->usuarios_repositorios
            ])
        @endif
    @endif
@endsection

@section('modo')
    @if(Auth::user()->existe_repositorio())
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav_repositorios')
    @endif
@endsection
