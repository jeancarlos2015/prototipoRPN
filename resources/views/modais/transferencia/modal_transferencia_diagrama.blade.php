@if (!empty($diagrama))
    <div class="modal fade" id="modal-form-transferencia-diagrama">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa fa-info faa-pulse  fa-2x">  Transferência De Diagrama</i>
                </div>


                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <tbody>
                                <tr><td style="font-weight: bold">Transferência do diagrama:</td><td>{!! $diagrama->nome !!}</td></tr>
                                <tr><td style="font-weight: bold">Autor:</td><td>{!! $diagrama->usuario->name !!}</td></tr>
                                <tr><td style="font-weight: bold">Modelo:</td><td>{!! $diagrama->modelo->nome !!}</td></tr>
                                <tr><td style="font-weight: bold">Transferido:</td><td>{!! $diagrama->transferido ? 'Sim' : 'Não' !!}</td></tr>
                                <tr><td style="font-weight: bold">Processo:</td><td>{!! $diagrama->projeto->nome !!}</td></tr>
                                <tr><td style="font-weight: bold">Repositório:</td><td>{!! $diagrama->repositorio->nome !!}</td></tr>
                                </tbody>
                            </table>


                        </div>
                    </div>

                        <div class="form-group">
                            <label>Exportar para os seguintes Modelos:</label>
                            <select id="selecao_transferencia_modelos" class="selectpicker form-control" name="codmodelo" data-live-search="true">
                                @foreach(Auth::getUser()->modelos() as $modelo)
                                    @if ($modelo->permissao())
                                        <option data-tokens="{!! $modelo->nome !!}"
                                                value="{!! $modelo->codmodelo !!}">{!! $modelo->nome !!} - Processo: {!! $modelo->projeto->nome !!}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input id="tipoPapel" type="hidden" name="tipo" value="5">
                        <input id="modalTransferenciaDiagramaCampo" type="hidden" name="codmodelodiagramatico"
                               value="{!! $diagrama->codmodelodiagramatico !!}">
                        <div class="modal-footer">
                            <button onclick="transferirDiagrama()" class="btn btn-dark form-control">Transferir</button>
                            <button type="button" class="btn btn-dark form-control" data-dismiss="modal">Fechar</button>
                        </div>

                </div>
            </div>
        </div>
    </div>
    <div id="GSCCModalCriacaoDiagramaAutomaticoNovoDiagrama" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-send faa-pulse  fa-2x"></i> Novo Diagrama</h4>
                </div>
                <form action="{!! route('controle_diagramas_automatico.store') !!}" method="post" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="modal-body">
                        <label>nome</label>
                        <input type="text" class="form-control" name="nome" required>
                        <input type="text" value="Novo Diagrama" name="texto" hidden>
                        <input type="text" value="{!! $modelo->codmodelo !!}" name="codmodelo" hidden>
                        @includeIf('componentes.botao_sim_nao',[
                        'name' => 'publico',
                        'pergunta' => 'Deseja tornar este Modelo/Representação Público?',
                        ])
                        <div class="form-group">
                            <input name="file" type="file" multiple/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark form-control" data-dismiss="modal">Fechar</button>
                        <input type="submit" class="btn btn-dark form-control" value="Modelar"/>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endif

