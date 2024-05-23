
@if (Auth::getUser()->usuario_esta_no_repositorio())

    <a onclick="confirmMensagemPersonalizado('{!! route('delete_vinculo_repositorio')!!}','Deseja sair do repositório')"
       class="btn btn-dark"
       style="cursor: pointer;color: white;margin-top: 10px">Sair Do
        Repositório: {!! Auth::getUser()->repositorio->nome !!}</a>

    @if (Auth::getUser()->EProprietario() && Auth::getUser()->usuario_esta_no_repositorio())

        <a class="btn btn-dark"
           data-toggle="modal"
           data-target="#GSCCModalRepositorioAtualizacao"
           style="cursor: pointer;color: white;margin-top: 10px"
           title="Esta funcionalidade permite que você edite um repositorio">Editar nome do repositorio</a>

        <a onclick="confirmMensagemPersonalizadoRepositorio('{!! route('gerar_relatorio_repositorio',[Auth::getUser()->codrepositorio]) !!}','Deseja gerar o relatorio do repositorio?')"
           class="btn btn-dark"
           style="cursor: pointer;color: white;margin-top: 10px"
           title="">Gerar Relatorio</a>

        <a class="btn btn-dark"
           data-toggle="modal"
           data-target="#modal-form-transferencia-processo"
           style="cursor: pointer;color: white;margin-top: 10px"
           title="Esta funcionalidade assume que o nome do diagrama será o mesmo do projeto e do modelo">Transferir
            Processos</a>

    @endif
    <a class="btn btn-dark"
       data-toggle="modal"
       data-target="#GSCCModalCriacaoDiagramaAutomatico"
       style="cursor: pointer;color: white;margin-top: 10px"
       title="Esta funcionalidade assume que o nome do diagrama será o mesmo do projeto e do modelo">Novo Diagrama</a>


@endif
@if(Auth::getUser()->EColaborador())
    <a class="btn btn-dark"
       data-toggle="modal"
       data-target="#GSCCModalProjetoCriacao"
       style="cursor: pointer;color: white;margin-top: 10px"
       title="Esta funcionalidade permite que você crie um processo">Novo Processo</a>
@endif

<a class="btn btn-dark"
   data-toggle="modal"
   data-target="#GSCCModalRepositorioCriacao"
   style="cursor: pointer;color: white;margin-top: 10px"
   title="Esta funcionalidade permite que você crie um repositorio">Novo Repositorio</a>

<ol class="breadcrumb" style="margin-top: 1%">
    @if(Auth::getUser()->usuario_esta_no_repositorio())
        <li class="breadcrumb-item"><a href="{!! route('painel') !!}"><i class="fa fa-database faa-pulse    "></i>
                Repositório {!! Auth::getUser()->repositorio->nome !!}</a></li>
    @endif
    <li class="breadcrumb-item active">
        <a href="{!! route('painel') !!}"> <i class="fa fa-dashboard faa-pulse "></i> Painel</a>
    </li>
</ol>
