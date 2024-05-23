<div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-send fa-2x"></i> Envio de mensagem</h4>
            </div>

                <div class="modal-body">
                    <label>Assunto</label>
                    <input type="text" class="form-control" name="assunto" required>
                    <label>Texto</label>
                    <textarea class="form-control" name="texto" required></textarea>

                    <div class="subject-info-box-1">
                        <label>Destinatários</label>
                        @if(!empty($usuarios))
                            <select multiple="multiple"  class="form-control" name="codusuarios[]" required>
                                @foreach($usuarios as $usuario)
                                    @if(Auth::getuser()->TemPermissaoParaEscluir())
                                        <option value="{!! $usuario->codusuario !!}" title="{!! $usuario->email !!}">{!! $usuario->name !!}
                                           </option>
                                    @else
                                        <option value="{!! $usuario->codusuario !!}">{!! $usuario->name !!} </option>
                                    @endif
                                @endforeach
                            </select>


                        @endif

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input  class="btn btn-primary" value="Enviar"/>
                </div>


        </div>
    </div>
</div>
