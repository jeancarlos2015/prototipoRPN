@extends('layouts.admin.layouts.layout_usuario.main')
@section('content')

    @if(Auth::getuser()->TemPermissaoParaEscluir())
        @if(Auth::getuser()->EAdministrador())
            @includeIf('layouts.admin.componentes.botao',
            [
            'tipo' => $tipo,
            'botao_usuario' => 'Novo Usuario',
            'rota' => 'controle_usuarios.create'
            ])
        @endif
        @if(Auth::getuser()->EProprietario() && !empty($usuarios))

            @includeIf('layouts.admin.componentes.tables',[
                                   'titulos' => $titulos,
                                   'usuarios' => $usuarios,
                                   'rota_edicao' => 'controle_usuarios.edit',
                                   'rota_exclusao' => 'controle_usuarios.destroy',
                                   'nome_botao' => 'Novo',
                                   'titulo' =>'Usuarios',
                   ])
        @elseif(Auth::getuser()->EProprietario())

            @includeIf('layouts.admin.componentes.tables',[
                                   'titulos' => $titulos,
                                   'usuarios' => Auth::user()->usuarios_do_repositorio_corrente(),
                                   'rota_edicao' => 'controle_usuarios.edit',
                                   'rota_exclusao' => 'controle_usuarios.destroy',
                                   'nome_botao' => 'Novo',
                                   'titulo' =>'Usuarios',
                   ])
        @elseif(Auth::user()->EAdministrador() && !empty($usuarios))
            @includeIf('layouts.admin.componentes.tables',[
                                  'titulos' => $titulos,
                                  'usuarios' => $usuarios,
                                  'rota_edicao' => 'controle_usuarios.edit',
                                  'rota_exclusao' => 'controle_usuarios.destroy',
                                  'nome_botao' => 'Novo',
                                  'titulo' =>'Usuarios'
                  ])
        @endif

    @endif
@endsection

@section('codigo_js')
    <script>
        $('#desvincular').on('submit', function () {
            var $this = $(this);    // reference to the current scope
            dialog.confirm({
                message: 'Deseja Desvincular Este Usuário?',
                confirm: function () {
                    $this.off('submit').submit();
                },
                cancel: function () {
                }
            });

            return false;
        });
    </script>
@endsection


@section('modal')
@includeIf('painel.modais.modais')
@endsection

@section('botoes_listar_atribuir')

    @if(Auth::getUser()->usuario_esta_no_repositorio())
        @includeIf('controle_repositorios.componentes.botoes_atribuicao_listagem_usuarios')
    @endif
   @includeIf('controle_usuario.componente.titulos_view_index_usuarios')
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

{{--@section('botao_batepapo')--}}
{{--    <li>--}}

{{--        <input type="image" src="{!! asset('img/batepapo.png') !!}" alt="Submit" width="25" data-toggle="modal"--}}
{{--               data-target="#modal-chat2020" title="Sala de Bate Papo">--}}
{{--    </li>--}}
{{--@endsection--}}

