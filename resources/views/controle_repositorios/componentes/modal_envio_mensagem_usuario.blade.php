
@if(!empty($usuarios_mensagens))
    @foreach($usuarios_mensagens as $usuario)
        @if(isset($usuario))
            <div id="GSCCModal{!! $usuario->codusuario !!}" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title" id="myModalLabel">Envio de mensagem
                                para {!! $usuario->name !!}</h4>

                        </div>
                        <form action="{!! route('controle_mensagens_store') !!}" method="post">
                            @method('POST')
                            @csrf
                            <div class="modal-body">
                                <label>Assunto</label>
                                <input type="text" class="form-control" name="assunto" required>
                                <label>Texto</label>
                                <textarea class="form-control" name="texto" rows="10" required></textarea>
                                <input type="hidden" value="{!! $usuario->codusuario !!}" name="codusuarios[]">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-primary" value="Enviar"/>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif
