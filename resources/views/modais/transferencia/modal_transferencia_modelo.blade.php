@if (!empty($modelo))
    <div class="modal fade" id="modal-form-transferencia-modelo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-info">Transferir Modelo {{$modelo->nome}} para:</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label>Projetos</label>
                            <select class="selectpicker form-control" name="codprojeto" data-live-search="true">
                                @foreach(Auth::getUser()->projetos() as $projeto)
                                    <option data-tokens="{!! $projeto->nome !!}"
                                            value="{!! $projeto->codprojeto !!}">{!! $projeto->nome !!} - Processo: {!! $projeto->nome !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="tipo" value="5">
                        <input type="hidden" name="codmodelo"
                               value="{!! $modelo->codmodelo !!}">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark form-control">Transferir</button>
                            <button type="button" class="btn btn-dark form-control" data-dismiss="modal">Fechar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endif

