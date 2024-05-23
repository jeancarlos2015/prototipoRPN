@if(isset($repositorio))
    <div id="modal-nome-repositorio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-info fa-2x" aria-hidden="true"></i> Repositório: {!! $repositorio->nome !!} </h4>
                </div>
                <div class="modal-body">
                    <label>Descrição:</label>
                    <p>{!! $repositorio->descricao !!}</p>

                    @if(Auth::user()->usuario_esta_no_repositorio())
                        <p>
                            Você é um {!! Auth::user()->papel() !!} deste repositório
                            poderá usar o sistema para criar diagramas, modelos e armazená-los
                            para uma posterior consulta. Sinta-se a vontade.
                        </p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@elseif(isset($modelo))
    <div id="modal-nome-repositorio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="graphics-document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Repositório: {!! $modelo->repositorio->nome !!} </h4>

                </div>


                <div class="modal-body">
                    <p>
                        <strong>Processo:</strong> {!! $modelo->projeto->nome !!}

                    </p>
                    <p>
                        <strong>Diagrama:</strong> {!! $modelo->nome !!}
                    </p>

                    <p>
                        <strong>Autor:</strong> {!! $modelo->usuario->name !!}
                    </p>

                    <div class="text-justify"  style="margin-top: 10px;">
                        <strong> Descrição Textual:</strong> <br>
                        {!! $modelo->descricao !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@elseif(isset($diagrama))
    <div id="modal-nome-repositorio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="graphics-document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Repositório: {!! $diagrama->repositorio->nome !!} </h4>

                </div>


                <div class="modal-body">
                    <p>
                        <strong>Processo:</strong> {!! $diagrama->projeto->nome !!}

                    </p>
                    <p>
                        <strong>Diagrama:</strong> {!! $diagrama->modelo->nome !!}
                    </p>

                    <p>
                        <strong>Autor:</strong> {!! $diagrama->usuario->name !!}
                    </p>

                    <div class="text-justify"  style="margin-top: 10px;">
                        <strong> Descrição Textual:</strong> <br>
                        {!! $diagrama->descricao !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


@endif
