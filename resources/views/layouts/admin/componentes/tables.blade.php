<!-- Example DataTables Card-->
<div class="card mb-3">
    <div class="card-header">
        @if(!empty($titulo))
            <i class="fa fa-table faa-pulse "></i> {!! $titulo !!}
            <i class="fa fa-table faa-pulse "></i> {!! $titulo !!}
        @endif
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    @includeIf('layouts.admin.componentes.tables_titulos')
                </tr>
                </thead>

                <tfoot>
                @includeIf('layouts.admin.componentes.tables_titulos')
                </tfoot>
                @switch($tipo)

                    @case('objetofluxo')
                    @includeIf('layouts.admin.componentes.tables_objetos_fluxos')
                    @break

                    @case('modelo')

                    @includeIf('layouts.admin.componentes.tables_modelos')
                    @break

                    @case('diagramatico')
                    @includeIf('layouts.admin.componentes.tables_modelos_diagramaticos')
                    @break

                    @case('declarativo')
                    @includeIf('layouts.admin.componentes.tables_modelos_declarativos')
                    @break

                    @case('projeto')
                    @includeIf('layouts.admin.componentes.tables_projetos')
                    @break

                    @case('repositorio')
                    @includeIf('layouts.admin.componentes.tables_repositorios')
                    @break

                    @case('usuario')
                    @includeIf('layouts.admin.componentes.tables_usuarios')
                    @break

                    @case('log')
                    @includeIf('layouts.admin.componentes.tables_logs')
                    @break

                    @case('documentacao')
                    @includeIf('layouts.admin.componentes.tables_documentacoes')
                    @break

                    @case('regra')
                    @includeIf('layouts.admin.componentes.tables_regras')
                    @break

                    @case('mensagem')
                    @includeIf('layouts.admin.componentes.tables_mensagens')
                    @break;

                    @case('solicitacao')
                    @includeIf('layouts.admin.componentes.tables_solicitacoes')
                    @break;

                    @case('diagrama_versionavel')
                    @includeIf('layouts.admin.componentes.tables_diagrama_versionaveis')
                    @break
                    @case('arquivo')
                    @includeIf('layouts.admin.componentes.tables_arquivos')
                    @break
                    @case('ConfiguracaoAmbienteModelagem')
                    @includeIf('layouts.admin.componentes.tables_configuracoes_ambiente_modelagem')
                    @break
                @endswitch
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted"></div>
</div>
