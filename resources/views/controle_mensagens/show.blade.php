@extends('layouts.admin.layouts.layout_usuario.main')
@section('content')
 @includeIf('controle_mensagens.Componentes.Conteudo')
@endsection


@section('botoes_listar_atribuir')

  @includeIf('controle_mensagens.Componentes.mensagem_responsavel')
@endsection

@section('menu_usuarios')
    @if(Auth::getuser()->TemPermissaoParaEscluir())
        @if(Auth::getUser()->usuario_esta_no_repositorio())
            @includeIf('menu.componentes.menu_usuarios',[
            'entradas' => Auth::user()->repositorio->usuarios_repositorios
            ])
            @if(collect(Auth::user()->solicitacoes)->count()>0)
                @includeIf('menu.componentes.menu_solicitacoes',[
                'solicitacoes' => Auth::user()->solicitacoes
                ])
            @endif
        @endif
    @endif
@endsection
