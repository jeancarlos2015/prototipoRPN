@if(!empty($solicitacoes))
    @foreach($solicitacoes  as $solicitacao)
        <div id="GSCCModalMensagemSolicitacao{!! $solicitacao->codsolicitacao !!}" class="modal fade" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fa fa-envelope-open fa-2x"></i></h3>
                    </div>
                    <div class="modal-body">
                        <ul style="list-style: none;">
                            <li>
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src($solicitacao->solicitante->email) }}"
                                     alt="" width="30">
                            </li>
                            <li>
                                <h4 style="margin-left: 48%;">Mensagem</h4>
                            </li>
                        </ul>

                        <textarea class="form-control" name="texto" rows="15" style="text-align: justify-all;" disabled>
                                    {!! $solicitacao->mensagem !!}
                                </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>


                </div>
            </div>
        </div>
    @endforeach
@else
    @foreach(Auth::getuser()->solicitacoes_cache()  as $solicitacao)
        <div id="GSCCModalMensagemSolicitacao{!! $solicitacao->codsolicitacao !!}" class="modal fade" tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><i class="fa fa-envelope-open fa-2x"></i></h3>
                    </div>
                    <div class="modal-body">
                        <ul style="list-style: none;">
                            <li>
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src($solicitacao->solicitante->email) }}"
                                     alt="" width="30">
                            </li>
                            <li>
                                <h4 style="margin-left: 48%;">Mensagem</h4>
                            </li>
                        </ul>

                        <textarea class="form-control" name="texto" rows="15" style="text-align: justify-all;" disabled>
                                    {!! $solicitacao->mensagem !!}
                                </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>


                </div>
            </div>
        </div>
    @endforeach
@endif


