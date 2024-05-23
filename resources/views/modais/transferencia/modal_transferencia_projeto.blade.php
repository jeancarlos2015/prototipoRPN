@if (Auth::getUser()->usuario_esta_no_repositorio())
    <div class="modal fade" id="modal-form-transferencia-processo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-info">Transferência de Processos</h4>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <label>Seus Processos</label>
                            <select id="selecao_transferencia_processos" class="selectpicker form-control" name="codprojeto" data-live-search="true">
                                @foreach(Auth::getUser()->projetos() as $processo)
                                    <option data-tokens="{!! $processo->nome !!}" value="{{$processo->codprojeto}}">{{$processo->nome}} - Repositorio: {{$processo->repositorio->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="text-align: center">
                            <i class="fa fa-arrow-circle-o-down fa-2x"></i>
                        </div>
                        <div class="form-group">
                            <label>Repositórios</label>
                            <select id="selecao_transferencia_repositorios" class="selectpicker form-control" name="codrepositorio" data-live-search="true">
                                @foreach(Auth::getUser()->repositorios_do_usuario() as $repositorio)
                                    <option data-tokens="{!! $repositorio->nome !!}" value="{{$repositorio->codrepositorio}}">{{$repositorio->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button onclick="transferirProcesso()" class="btn btn-dark form-control">Transferir Processo</button>
                            <button type="button" class="btn btn-dark form-control" data-dismiss="modal">Fechar</button>
                        </div>


                </div>
            </div>
        </div>
    </div>

@endif

