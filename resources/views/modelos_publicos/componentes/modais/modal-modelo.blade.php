
<div id="modal-nome-modelo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modelo: {!! $modelo->nome !!} </h4>
            </div>
            <div class="modal-body">
                <table>
                    <tbody>
                    <tr><td width="50%">Modelo:</td><td>{!! $modelo->nome !!}</td></tr>
                    <tr><td width="50%">Processo:</td><td>{!! $modelo->projeto->nome !!}</td></tr>
                    <tr><td width="50%">Repositorio:</td><td>{!! $modelo->repositorio->nome !!}</td></tr>
                    <tr><td width="50%">Data Criação:</td><td>{!! $modelo->created_at->format('d/m/Y H:i:s')!!}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
