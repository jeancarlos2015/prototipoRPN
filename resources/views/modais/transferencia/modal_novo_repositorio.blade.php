<div id="GSCCModalCriacaoDiagramaAutomaticoNovoDiagrama" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-send fa-2x"></i> Novo Repositório</h4>
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
