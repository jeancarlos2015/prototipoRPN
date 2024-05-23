@extends('layouts.admin.layouts.layout_repositorio.main')
@section('content')
    <li class="breadcrumb-item"><a href="{!! route('painel') !!}"><i class="fa fa-dashboard"></i> Painel</a></li>
    <li class="breadcrumb-item active"><a href="{!! route('controle_repositorios.index') !!}"><i
                    class="fa fa-database"></i> Repositórios</a></li>


    @if(Auth::user()->usuario_esta_no_repositorio())
        @if(Auth::getuser()->EAdministrador())
            @if(!empty($repositorios) && !empty($titulos))
                @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
                @includeIf('layouts.admin.componentes.tables',[
                                'titulos' => $titulos,
                                'repositorios' => $repositorios,
                                'rota_edicao' => 'controle_repositorios.edit',
                                'rota_exclusao' => 'controle_repositorios.destroy',
                                'rota_cricao' => 'controle_repositorios.create',
                                'rota_exibicao' => 'controle_repositorios.show',
                                'nome_botao' => 'Novo',
                                'titulo' =>'Repositórios - Clique no repositório desejado para gerenciar seus Processos!!',
                                'tipo' => $tipo

                ])
            @endif
        @else
            @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
            @includeIf('layouts.admin.componentes.tables',[
                            'titulos' => $titulos,
                            'repositorios' => $repositorios,
                            'rota_exibicao' => 'controle_repositorios.show',
                            'nome_botao' => 'Novo',
                            'titulo' =>'Repositórios - Clique no repositório desejado para gerenciar seus Processos!!',
                            'tipo' => $tipo

            ])

        @endif
    @elseif(Auth::getuser()->EAdministrador())
        @if(!empty($repositorios) && !empty($titulos))
            @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
            @includeIf('layouts.admin.componentes.tables',[
                            'titulos' => $titulos,
                            'repositorios' => $repositorios,
                            'rota_edicao' => 'controle_repositorios.edit',
                            'rota_exclusao' => 'controle_repositorios.destroy',
                            'rota_cricao' => 'controle_repositorios.create',
                            'rota_exibicao' => 'controle_repositorios.show',
                            'nome_botao' => 'Novo',
                            'titulo' =>'Repositórios - Clique no repositório desejado para gerenciar seus Processos!!',
                            'tipo' => $tipo

            ])
        @endif

    @endif
@endsection
@section('titulo')

    @includeIf('controle_repositorios.componentes.titulos_view_index_repositorios')
@endsection

@section('menu_usuarios')
    @if(empty(Auth::user()->usuario_esta_no_repositorio()))
        @includeIf('menu.componentes.menu_usuarios')
    @endif
@endsection


@section('modal')
    @if(Auth::user()->EAdministrador() && !Auth::user()->usuario_esta_no_repositorio())
        @includeIf('controle_repositorios.componentes.modal_envio_mensagem_usuario',[
          'usuarios_mensagens' => Auth::user()->usuarios(),
          'mensagens' => Auth::getUser()->mensagens()
          ])

{{--        @includeIf('controle_repositorios.componentes.modal_atribuicao_usuarios')--}}
        @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
        [
        'tipo_modal' => 'modal_repositorio',
        'titulo' => 'repositorio'
        ])
        @includeIf('painel.componentes.modal_mensagens_usuario',['entradas' => Auth::getUser()->UsuariosRepositorios()])
        @includeIf('controle_repositorios.componentes.modal_envio_mensagens',['usuarios' => Auth::getUser()->Usuarios()])
        @includeIf('modais.chat.chat_modal')
    @endif
@endsection

