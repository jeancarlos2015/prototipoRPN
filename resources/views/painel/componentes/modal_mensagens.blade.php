
{{--@if(!empty($mensagens))--}}
{{--    @foreach($mensagens as $mensagem)--}}
{{--        @if(!empty($mensagem))--}}
{{--            <div id="GSCCModalMensagem{!! $mensagem->codmensagem !!}" class="modal fade" tabindex="-1" role="dialog"--}}
{{--                 aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--                <div class="modal-dialog">--}}
{{--                    <div class="modal-content">--}}

{{--                        <form action="{!! route('controle_mensagens_update',[$mensagem->codmensagem]) !!}" method="post">--}}
{{--                            @method('PUT')--}}
{{--                            @csrf--}}
{{--                            <div class="modal-body">--}}
{{--                                <label>Assunto</label>--}}
{{--                                <input type="text" class="form-control" name="assunto" value="{!! $mensagem->assunto !!}" disabled>--}}
{{--                                <label>Texto</label>--}}
{{--                                <textarea class="form-control" name="texto" rows="5" style="text-align: justify-all;" disabled>--}}
{{--                                    {!! $mensagem->texto !!}--}}
{{--                                </textarea>--}}
{{--                                <input type="hidden" value="{!! $mensagem->codusuario !!}" name="codusuarios[]">--}}
{{--                            </div>--}}

{{--                            <div class="modal-footer">--}}
{{--                                <input type="submit" class="btn btn-primary bg-dark form-control" value="Arquivar">--}}
{{--                                <button type="button" class="btn btn-primary bg-dark form-control" data-dismiss="modal">Fechar</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @endforeach--}}
{{--@endif--}}
