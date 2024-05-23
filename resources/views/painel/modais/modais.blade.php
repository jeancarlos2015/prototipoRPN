@includeIf('painel.componentes.modal_mensagens_usuario')
@includeIf('modais.AcessosRecentes.AcessosRecentes')
@includeIf('modais.criacao_repositorio.criacao_repositorio')
@includeIf('modais.edicao_repositorio.modal_edicao_repositorio')


@if(Auth::user()->usuario_esta_no_repositorio())

    @includeIf('controle_repositorios.componentes.modal_envio_mensagens',['usuarios' => Auth::getUser()->repositorio->usuarios_do_repositorio()])

    @includeIf('painel.componentes.modal_nome_repositorio',['repositorio' => Auth::getUser()->repositorio])
    {{--    @includeIf('modais.chat.chat_modal')--}}

    @include('controle_modelos_diagramaticos.componentes.modal_lista_diagramas')
    @include('modais.transferencia.modal_transferencia_projeto')
    @includeIf('painel.componentes.modal_vinculacao_usuarios',
    [
    'solicitacoes' => Auth::getUser()->solicitacoes_painel(),
    'rota_vinculo' => 'vincular_usuario_repositorio',
    'titulo' => 'repositorio',
    'tipos' => ['PROPRIETARIO','COLABORADOR','CLIENTE'],
    'repositorio' => Auth::getUser()->repositorio
    ])

    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
    [
    'entradas' => Auth::getUser()->repositorio->usuarios_repositorios,
    'tipo_modal' => 'modal_repositorio',
    'titulo' => 'repositorio'
    ])
    @includeIf('painel.componentes.modal_criacao_diagrama_automatico')

@elseif(Auth::getUser()->EAdministrador())
    @includeIf('controle_repositorios.componentes.modal_envio_mensagens',['usuarios' => Auth::getUser()->Usuarios()])

    @includeIf('controle_modelos.componentes.modal_form_comentario',['modelos' => Auth::user()->todos_modelos()])





    @includeIf('controle_repositorios.componentes.modal_listagem_usuarios',
    [
    'tipo_modal' => 'modal_repositorio',
    'titulo' => 'repositorio',
    'entradas' => Auth::getUser()->UsuariosRepositorios()
    ])


    @includeIf('modais.solicitacoes.modal_solicitacoes',
    [
    'solicitacoes' => Auth::getUser()->solicitacoes_painel(),
    'tipo_modal' => 'modal_repositorio',
    'titulo' => 'repositorio'
    ])



@endif





