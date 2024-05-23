<div class="container-fluid" style="zoom: 80%">

    @yield('titulo')
    @Auth
        @if (Auth::user()->usuario_esta_no_repositorio() || Auth::getuser()->EAdministrador())
            @includeIf('controle_repositorios.componentes.botoes_atribuicao_listagem_usuarios',[
            'lupa' => 'true'
            ])
        @endif
        @yield('informacoes_tela')
    @endauth
    @yield('content')
    @includeIf('painel.componentes.modal_mensagem_aviso')
    @Auth

        @if (Auth::getUser()->EAdministrador())
            @includeIf('painel.componentes.modal_vinculacao_usuarios',[
            'solicitacoes' => Auth::user()->todas_solicitacoes(),
            'rota_vinculo' => 'vincular_usuario_repositorio',
            'titulo' => 'repositorio',
            'tipos' => ['PROPRIETARIO', 'COLABORADOR', 'CLIENTE']
            ])
            @includeIf('modais.solicitacoes.modal_solicitacoes',
            [
            'solicitacoes' => Auth::user()->todas_solicitacoes(),
            ])
        @endif
    @endauth
    @includeIf('painel.modais.modais')
    @yield('modal')
    @includeIf('modais.repositorios.repositorios')
    @includeIf('modais.chat.chat_modal')
    @includeIf('modais.avisos.modal_aviso')
    @if (Auth::getUser()->EAdministrador())
        @includeIf('modais.avisos.modal_form_aviso')
    @endif
    @yield('graficos')
    <div class="row para-baixo">
        @yield('cards')
    </div>

</div>

@section('meta_usuario_logado')

    <meta name="description"
        content="{{ Auth::user()->name }}, Esta página visa exibir todas as funcionalidades do BPMN.">
    <meta name="keywords" content="{{ Auth::user()->id }}, Usuários BPMN, Diagramas BPMN, DashBoard">
    <meta name="robots"
        content="{{ Auth::user()->id }}, Painel contendo um paronama geral dos modelos, usuários, Diagramas, Modelos, Processos e Repositórios.">
    <meta name="author" content="{{ Auth::user()->id . Auth::user()->name }}">
@endsection
