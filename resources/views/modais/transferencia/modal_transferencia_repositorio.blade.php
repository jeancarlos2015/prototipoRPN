@if (Auth::getUser()->usuario_esta_no_repositorio())

        <div class="modal fade" id="modal-form-transferencia-repositorio">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text-info">Transferir Repositório {{Auth::getUser()->repositorio->nome}} para:</h4>
                    </div>
                    <div class="modal-body">

                            <div class="form-group">
                                <label>Repositórios</label>
                                <select class="selectpicker form-control" name="codrepositorioOrigem">
                                    @foreach(Auth::getUser()->repositorio() as $repositorio)
                                        <option value="{{$repositorio->codrepositorio}}">{{$repositorio->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="tipo" value="5">
                            <input type="hidden" name="codrepositorioDestino"
                                   value="{!! Auth::getUser()->codrepositorio !!}">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-dark form-control">Transferir</button>
                                <button type="button" class="btn btn-dark form-control" data-dismiss="modal">Fechar</button>
                            </div>

                    </div>
                </div>
            </div>
        </div>


@endif

