
{{--        <div id="GSCCModalSolicitacaoRepositorio" class="modal fade" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--            <div class="modal-dialog">--}}
{{--                <div class="modal-content">--}}

{{--                        <form onsubmit="return confirm('Deseja participar da organização?');"--}}
{{--                              action="{!! route('solicitacao_usuario') !!}" method="post"--}}
{{--                              style="display: inline-block">--}}
{{--                            @csrf--}}
{{--                            @method('POST')--}}

{{--                            <input type="hidden" value="{!! $repositorio->codrepositorio !!}" name="codrepositorio">--}}
{{--                            <input type="hidden" value="{!! Auth::getUser()->codusuario !!}" name="codusuario">--}}
{{--                            <input type="hidden" value="solicitacao" name="tipo">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h3 style="text-align: center;"><i class="fa fa-envelope-open fa-2x"></i></h3>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                <h5 style="text-align: center;">Mensagem de Solicitação</h5>--}}
{{--                                <textarea class="form-control" name="mensagem" rows="5" style="text-align: justify-all;">--}}
{{--                                </textarea>--}}
{{--                                <input style="margin-left: 48%;margin-top: 2%;" type="image" src="{!! asset('img/door-ico.ico') !!}" alt="Submit" width="70"--}}
{{--                                       title="Participar">--}}
{{--                            </div>--}}


{{--                        </form>--}}

{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
