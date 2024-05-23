@if(!empty($representacao_diagramatica->modelo->papel()))

    <div id="canvas"></div>

    <div class="form-group">
            <button onclick="exportDiagram('{!! $representacao_diagramatica->codmodelodiagramatico !!}')"
                    id="save-button">
                Salvar Modelo
            </button>

    </div>
    <div class="form-group" id="descricao-label-id3" style="display: none;">
        <label class="descricao-label">
            Modelo: {!! $representacao_diagramatica->modelo->nome !!} <br>
            Projeto: {!! $representacao_diagramatica->projeto->nome !!} <br>
            Repositório: {!! $representacao_diagramatica->repositorio->nome !!}
        </label>
    </div>
@else
    <div class="alert alert-warning">
        <strong>Não está autorizado!</strong> Algum proprietário impediu o seu acesso a este documento.
    </div>
@endif
